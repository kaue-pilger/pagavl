<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ReadTransactions from './Partials/ReadTransactions.vue';
import { usePage } from '@inertiajs/vue3';
import CreateTransaction from './Partials/CreateTransaction.vue';

// Definindo as props recebidas
const props = defineProps({
    transactions: Array, // Recebendo as transações como props
});

// Função para editar transação
function editTransaction(id) {
    // Usando a Inertia para navegar para a página de edição
    this.$inertia.get(`/transactions/edit/${id}`);
}

// Função para excluir transação
function deleteTransaction(id) {
    if (confirm('Você tem certeza que deseja excluir esta transação?')) {
        // Usando a Inertia para enviar a requisição DELETE
        this.$inertia.delete(`/transactions/${id}`);
    }
}
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transactions</h2>
        </template>

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
