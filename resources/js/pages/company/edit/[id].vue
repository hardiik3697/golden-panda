<script setup>
const refVForm = ref([])

definePage({
  meta: {
    navActiveLink: 'company',
    key: 'id',
  },
})

const route = useRoute('company-edit-id')

const CompanyId = computed({
  get: () => route.params.id,
  set: () => route.params.id,
})

const formData = ref({
  name: '',
  address: '',
  initialBank: '0',
  draws: '',
})

const items = [
  'daily',
  'specific_time_daily',
  'weekly',
  'monthly',
]

const fetchCompanyData = async val => {
  try {
    const res = await $api(`/companies/edit/${val}`, {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    const data = res.data

    console.log(data)
    formData.value.id = data.id
    formData.value.name = data.name
    formData.value.address = data.address
    formData.value.initialBank = data.initial_bank
    formData.value.draws = data.draws
  } catch (err) {
    console.error(err)
  }
}

const onSubmit = () => {
  refVForm.value?.validate().then(({ valid: isValid }) => {
    if (isValid)
      storeCompany()
  })
}

const storeCompany = async () => {
  try {
    const res = await $api('/companies/store', {
      method: 'POST',
      body: {
        id: formData.value.id,
        name: formData.value.name,
        address: formData.value.address,
        initialBank: formData.value.initialBank,
        draws: formData.value.draws,
      },
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    await nextTick(() => {
      router.push(route.query.to ? String(route.query.to) : '/company')
    })
  } catch (err) {
    console.error(err)
  }
}

// Fetch companies when the component is mounted
onMounted(() => {
//   if (CompanyId.value) {
  fetchCompanyData(CompanyId.value)

//   } else {
//     console.error('Company ID is missing in route params.')
//   }
})
</script>

<template>
  <VCard class="overflow-visible">
    <div class="w-100 sticky-header overflow-hidden rounded-t">
      <div class=" d-flex align-center gap-4 flex-wrap bg-custom-background pa-6">
        <VCardTitle>Update Company</VCardTitle>
        <VSpacer />
      </div>
    </div>
    <VCardText>
      <VForm
        ref="refVForm"
        @submit.prevent="() => {}"
      >
        <VRow>
          <VCol cols="12">
            <!-- 👉 Username -->
            <VTextField
              v-model="formData.name"
              label="Name"
              placeholder="Google"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Email -->
            <VTextarea
              v-model="formData.address"
              label="Address"
              counter
              placeholder="1456, Mall Road"
              rows="2"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Password -->
            <VTextField
              v-model="formData.initialBank"
              label="Initial Bank"
              type="number"
              placeholder="0"
              :rules="[requiredValidator, integerValidator]"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Autocomplete -->
            <VSelect
              v-model="formData.draws"
              :items="items"
              label="Draws"
              clearable
              placeholder="Select"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4"
          >
            <!-- 👉 submit and reset button -->
            <VBtn
              type="button"
              @click="onSubmit"
            >
              Submit
            </VBtn>

            <VBtn
              color="secondary"
              type="button"
              variant="tonal"
              :to="{ name:'company' }"
            >
              Cancel
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>
