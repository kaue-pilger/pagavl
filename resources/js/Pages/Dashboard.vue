<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Dash from '@/Components/Dash.vue';
  import { Head } from '@inertiajs/vue3';

  const content = "Teste"
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1 class="text-4xl text-daintree font-bold">All accounts</h1>
      <div class="flex flex-col mt-6">
        <span class="oslo-gray">Available balances</span>
        <div class="flex flex-row gap-8 mt-2">
          <div class="flex flex-row justify-center items-center text-center gap-4">
            <img class="rounded-full" src="https://flagsapi.com/DE/flat/48.png">
            <h4>EUR</h4>
            <h4>3.600</h4>
          </div>
          <div class="flex flex-row justify-center items-center text-center gap-2">
            <img class="rounded-full" src="https://flagsapi.com/US/flat/48.png">
            <h4>USD</h4>
            <h4>3.600</h4>
          </div>
          <div class="flex flex-row justify-center items-center text-center gap-2">
            <img class="rounded-full" src="https://flagsapi.com/BR/flat/48.png">
            <h4>REAL</h4>
            <h4>3.600</h4>
          </div>
        </div>
      </div>

      <div class="flex flex-col flex-grow w-full gap-4 mt-8">
        <div class="flex flex-row w-full gap-4">
          <Dash> Teste 2 </Dash>
          <Dash> Teste </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash> Teste </Dash>
          <Dash> Teste </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash> Teste </Dash>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
