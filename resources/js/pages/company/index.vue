<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const companies = ref([])
const isSnackbarVisible = ref(false)
const SnackbarMessage = ref('')
const SnackbarMessageColor = ref('')

// Fetch the list of companies
const fetchCompanies = async () => {
  try {
    const response = await $api('/companies', {
      method: 'GET',
    })

    companies.value = response.data
  } catch (error) {
    isSnackbarVisible.value = true
    SnackbarMessage.value = 'Failed to fetch companies.'
    SnackbarMessageColor.value = 'error',

    console.error('Error fetching companies:', error)
  }
}

// Handle edit action
const editItem = val => {
  router.push({ name: 'pages-company-edit', params: { id: val } })
}

// Handle delete action
const deleteItem = async val => {
  try {
    const response = await $api(`/companies/delete/${val}`, {
      method: 'GET',
    })

    // const { statusCode, message, data } = response || {}

    console.log(response.code, response.status)
    if (response.status === 200) {
      isSnackbarVisible.value = true
      SnackbarMessage.value = 'Company deleted successfully!'
      SnackbarMessageColor.value = 'success'

      await fetchCompanies() // Reload the company list
    } else {
      isSnackbarVisible.value = true
      SnackbarMessage.value = response.message || 'Failed to delete company.'
      SnackbarMessageColor.value = 'error'
    }

  } catch (error) {
    isSnackbarVisible.value = true
    SnackbarMessage.value = 'Failed to fetch companies.'
    SnackbarMessageColor.value = 'error',
    console.error('Error deleting company:', error)
  }
}

// Fetch companies when the component is mounted
onMounted(fetchCompanies)
</script>

<template>
  <VSnackbar v-model="isSnackbarVisible">
    {{ SnackbarMessage }}
  </VSnackbar>
  <div>
    <VRow cols="12">
      <VCol cols="10" />
      <VCol
        cols="2"
        class="d-flex align-right"
      >
        <VBtn
          rounded="pill"
          variant="outlined"
          color="primary"
          :to="{ name: 'company-create' }"
        >
          <VIcon
            start
            icon="ri-add-line"
          />
          Add Company
        </VBtn>
      </VCol>
      <VCol cols="12">
        <CompanyDataTable
          :data="companies"
          @edit-item="editItem"
          @delete-item="deleteItem"
        />
      </VCol>
    </VRow>
  </div>
</template>
