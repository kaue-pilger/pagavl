<!-- App.vue -->
<script setup>
import Sidebar from '@/Components/Sidebar.vue';

const links = [
  { id: 1, name: 'Get Started', url: 'get-started' },
  { id: 2, name: 'Dashboard', url: 'dashboard' },
  { id: 3, name: 'Transactions', url: 'transactions' },
];

</script>

<template>
  <div class="flex h-screen">
    <!-- Sidebar occupies 1/4 of the screen on desktop -->
    <div class="w-1/4">
      <Sidebar :links="links" />
    </div>

    <!-- Main content occupies the remaining 3/4 -->
    <div class="w-3/4 bg-white">
      <slot />
    </div>
  </div>
</template>
