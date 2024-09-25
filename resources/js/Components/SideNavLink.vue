<script setup>
  import { computed } from 'vue';
  import { Link } from '@inertiajs/vue3';

  const props = defineProps({
    href: {
      type: String,
      required: true,
    },
    active: {
      type: Boolean,
    },
  });

  const classes = computed(() =>
    props.active
      ? 'flex w-full h-full px-4 py-2 items-center text-sm font-medium text-oslo-gray focus:outline-none hover:text-white'
      : 'flex w-full h-full px-4 py-2 items-center text-sm font-medium text-oslo-gray focus:outline-none hover:text-white'
  );
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
