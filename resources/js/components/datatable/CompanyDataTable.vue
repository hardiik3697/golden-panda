<script setup>
import { ref, watch } from 'vue'

// Define props
const props = defineProps({
  data: {
    type: Array,
    default: () => [],
  },
})

// Emit events for parent actions
const emit = defineEmits(['editItem', 'deleteItem'])

const userList = ref([])

const headers = [
  {
    title: 'ID',
    key: 'id',
  },
  {
    title: 'NAME',
    key: 'name',
  },
  {
    title: 'ADDRESS',
    key: 'address',
  },
  {
    title: 'INITIAL_BANK',
    key: 'initial_bank',
  },
  {
    title: 'INITIAL_DEVICE_READING',
    key: 'initial_device_reading',
  },
  {
    title: 'DRAWS',
    key: 'draws',
  },
  {
    title: 'ACTION',
    key: 'action',
  },
]

watch(
  () => props.data,
  newValue => {
    userList.value = newValue
  },
  { immediate: true },
)

const options = ref({
  page: 1,
  itemsPerPage: 5,
  sortBy: [''],
  sortDesc: [false],
})

const editItem = val => {
  emit('editItem', val)
}

const deleteItem = val => {
  emit('deleteItem', val)
}
</script>


<template>
  <VDataTable
    :headers="headers"
    :items="userList"
    :items-per-page="options.itemsPerPage"
    :page="options.page"
    :options="options"
    class="text-no-wrap"
  >
    <!-- full name -->
    <template #item.name="{ item }">
      <div class="d-flex align-center">
        <span class="text-sm">{{ avatarText(item.name) }}</span>
        <div class="d-flex flex-column ms-3">
          <span class="d-block font-weight-medium text-high-emphasis text-truncate">{{ item.name }}</span>
        </div>
      </div>
    </template>

    <!-- Initial Device reading -->
    <template #item.initial_device_reading="{ item }">
      <div class="d-flex align-center">
        <span class="text-sm">{{ avatarText(item.initial_device_reading) }}</span>
        <div class="d-flex flex-column ms-3">
          <span class="d-block font-weight-medium text-high-emphasis text-truncate">{{ item.initial_device_reading ?? 0 }}</span>
        </div>
      </div>
    </template>

    <!-- Draw -->
    <template #item.draws="{ item }">
      <div class="d-flex align-center">
        <span class="text-sm">{{ avatarText(item.draws) }}</span>
        <div class="d-flex flex-column ms-3">
          <span class="d-block font-weight-medium text-high-emphasis text-truncate">{{ item.draws ?? '-' }}</span>
        </div>
      </div>
    </template>

    <!-- Action -->
    <template #item.action="{ item }">
      <div class="d-flex gap-1">
        <IconBtn
          size="small"
          @click="editItem(item.id)"
        >
          <VIcon icon="ri-pencil-line" />
        </IconBtn>
        <IconBtn
          size="small"
          @click="deleteItem(item.id)"
        >
          <VIcon icon="ri-delete-bin-line" />
        </IconBtn>
      </div>
    </template>

    <!-- status -->
    <template #item.status="{ item }">
      <VChip
        :color="resolveStatusVariant(item.status).color"
        class="font-weight-medium"
        size="small"
      >
        {{ resolveStatusVariant(item.status).text }}
      </VChip>
    </template>
  </VDataTable>
</template>
