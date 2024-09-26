<script setup lang="ts">
import Dash from '@/Components/Dash.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <AuthenticatedLayout>
    <Dash :dash-title="'Get Started'" :dash-subtitle="'Visit our GitHub!'">
      <a href="https://github.com/kaue-pilger/pagavl" target="_blank">
        Click here
      </a>
    </Dash>
  </AuthenticatedLayout>
</template>