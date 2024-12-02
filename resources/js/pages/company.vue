<script setup>
import { onMounted, ref } from 'vue'

const companies = ref([])
const isSnackbarVisible = ref(false)
const SnackbarMessage = ref('')
const SnackbarMessageColor = ref('')

// Fetch the list of companies
const fetchCompanies = async () => {
  alert('called')
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
  console.log('Edit item with ID:', val)

  // Perform edit logic here, such as navigating to the edit page or opening a modal
}

// Handle delete action
const deleteItem = async val => {
  try {
    const response = await $api(`/companies/delete/${val}`, {
      method: 'GET',
    })

    const { statusCode, message, data } = response || {}

    console.log(response.statusCode, statusCode, message, data)
    if (response.code === 200) {
      isSnackbarVisible.value = true
      SnackbarMessage.value = 'Company deleted successfully!'
      SnackbarMessageColor.value = 'success',

      await fetchCompanies() // Reload the company list
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
    <VRow>
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
