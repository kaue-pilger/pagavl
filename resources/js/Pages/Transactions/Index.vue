<script setup>
  import { defineProps } from 'vue';
  
  import { Head } from '@inertiajs/vue3';
  import { usePage } from '@inertiajs/vue3';

  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import ReadTransactions from './Partials/ReadTransactions.vue';
  import CreateTransaction from './Partials/CreateTransaction.vue';

  const props = defineProps({
    transactions: Array,
  });

  function editTransaction(id) {
    this.$inertia.patch(`api/transactions/${id}`);
  }

  function deleteTransaction(id) {
    if (confirm('Are you sure about this action?')) {
        this.$inertia.delete(`api/transactions/${id}`);
    }
  }
</script>

<template>
    <Head title="Transactions" />

    <AuthenticatedLayout>
      <h1 class="text-2xl font-bold">Transactions Area</h1>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateTransaction class="max-w-xl" />
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ReadTransactions 
                        :transactions="transactions" 
                        @edit="editTransaction" 
                        @delete="deleteTransaction"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
