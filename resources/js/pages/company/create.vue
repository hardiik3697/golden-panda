<script setup>
const username = ref('')
const email = ref('')
const password = ref()
const checkbox = ref(false)

const items = [
  'foo',
  'bar',
  'fizz',
  'buzz',
]

const values = ref([])
</script>

<template>
  <VCard>
    <VCol cola="12">
      <div class="w-100 sticky-header overflow-hidden rounded-t">
        <VCardTitle>Create Company</VCardTitle>
        <VSpacer />
      </div>
      <VForm @submit.prevent="() => {}">
        <VRow>
          <VCol cols="12">
            <!-- 👉 Username -->
            <VTextField
              v-model="name"
              label="Name"
              placeholder="Google"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Email -->
            <VTextarea
              v-model="address"
              label="Address"
              placeholder="1456, Mall Road"
              rows="2"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Password -->
            <VTextField
              v-model="initialBank"
              label="Initial Bank"
              type="number"
              placeholder="0"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Autocomplete -->
            <VAutocomplete
              v-model="values"
              :items="items"
              chips
              multiple
              label="Draws"
              placeholder="Select"
            />
          </VCol>

          <VCol cols="12">
            <!-- 👉 Checkbox -->
            <VCheckbox
              v-model="checkbox"
              label="Remember me"
            />
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4"
          >
            <!-- 👉 submit and reset button -->
            <VBtn type="submit">
              Submit
            </VBtn>

            <VBtn
              color="secondary"
              type="reset"
              variant="tonal"
            >
              Reset
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCol>
  </VCard>
</template>
