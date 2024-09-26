<script setup>
  const props = defineProps({
    dashTitle: {
      type: String
    },
    dashSubtitle: {
      type: String
    }
  })
</script>

<template>
  <div class="flex flex-col w-full gap-2 p-4 bg-black-haze shadow-sm rounded-xl">
    <div class="flex flex-col">
      <span class="text-lg text-daintree">{{ dashTitle }}</span>
      <span class="text-xs text-oslo-gray">{{ dashSubtitle }}</span>
    </div>
    <slot />
  </div>
</template>
