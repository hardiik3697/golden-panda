<script setup>
const refVForm = ref([])

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
</script>

<template>
  <VCard class="overflow-visible">
    <div class="w-100 sticky-header overflow-hidden rounded-t">
      <div class=" d-flex align-center gap-4 flex-wrap bg-custom-background pa-6">
        <VCardTitle>Create Company</VCardTitle>
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

<style lang="scss" scoped>
.sticky-header {
  position: sticky;
  z-index: 9;
  transition: all 0.3s ease-in-out;
}
</style>
