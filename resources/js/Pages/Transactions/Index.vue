<script setup>
  import { defineProps } from 'vue';
  
  import { Head } from '@inertiajs/vue3';

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import ReadTransactions from './Partials/ReadTransactions.vue';
  import CreateTransaction from './Partials/CreateTransaction.vue';

  const props = defineProps({
    transactions: Array,
  });
</script>

<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
      <div class="h-screen overflow-y-auto p-8">
        <h1 class="text-4xl text-daintree font-bold">All Transactions</h1>
  
        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-black-haze shadow sm:rounded-lg">
              <CreateTransaction class="max-w-xl" />
            </div>
            <div class="p-4 sm:p-8 bg-black-haze shadow sm:rounded-lg">
              <ReadTransactions :transactions="transactions" />
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
</template>
