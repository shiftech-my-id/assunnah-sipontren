<template>
  <div class="standard-checkbox">
    <q-checkbox
      class="full-width"
      v-model="modelValue"
      :disable="disable"
      :label="label"
    />
  </div>
</template>

<script setup>
import { computed } from 'vue'

// props
const props = defineProps({
  modelValue: {
    type: Boolean,
    required: true
  },
  disable: {
    type: Boolean,
    default: false
  },
  label: {
    type: String,
    default: ''
  }
})

// emit
const emit = defineEmits(['update:modelValue'])

// bikin bridge v-model
const modelValue = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val)
})

const disable = props.disable
const label = props.label
</script>

<style scoped>
.standard-checkbox {
  margin-left: -10px;
}
</style>
