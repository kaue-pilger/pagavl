<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Dash from '@/Components/Dash.vue';

  import { Head } from '@inertiajs/vue3';
  import { ref, onMounted } from 'vue';

  import axios from 'axios';

  const totalsByCurrency = ref([]);
  const totalsByPaymentMethods = ref([]);
  const totalTransactions = ref(0);
  const total = ref(0);
  const exchange = ref(1);
  const totalWithExchange = ref(0);

  const calculateTotal = () => {
    totalTransactions.value = Object.values(totalsByPaymentMethods.value).reduce((accumulator, currentValue) => {
      return accumulator + currentValue;
    }, 0);
  };

  const calculateTotalWithExchange = (currenciesArray) => {
    total.value = 0; // Reset the total before each calculation

    currenciesArray.value.forEach((currencyObj) => {
      total.value += parseInt(currencyObj.total); // Access the Object value with .value
    });

    totalWithExchange.value = total.value * exchange.value;
  };

  const paymentMethodNames = {
    "1": "Credit Card",
    "2": "Debit Card",
    "3": "PIX"
  };

  const currencyFlags = {
    "EUR": "https://flagpedia.net/data/org/w580/eu.webp",
    "USD": "https://flagpedia.net/data/flags/w580/us.webp",
    "REAL": "https://flagpedia.net/data/flags/w580/br.webp"
  };

  const getPaymentMethodName = (method) => {
    return paymentMethodNames[method] || "Unknown Method";
  };

  const getCurrencyFlag = (currency) => {
    return currencyFlags[currency] || "Unknown Currency";
  };

  onMounted(async () => {
    try {
      const [currencyResponse, paymentMethodsResponse] = await Promise.all([
        axios.get('/api/transactions/by-currency'),
        axios.get('/api/transactions/by-payment-methods')
      ]);

      totalsByCurrency.value = currencyResponse.data;
      calculateTotalWithExchange(totalsByCurrency);

      totalsByPaymentMethods.value = paymentMethodsResponse.data;
      calculateTotal();

    } catch (error) {
      console.error('Error trying to get API response:', error);
    }
  });
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1 class="text-4xl text-daintree font-bold">All accounts</h1>
      <div class="flex flex-col mt-6">
        <span class="oslo-gray">Available balances</span>
        <div class="flex flex-row gap-8 mt-2">
          <div class="flex flex-row justify-center items-center text-center gap-4" v-for="(total, index) in totalsByCurrency" :key="index">
            <img class="w-10 h-10 rounded-full" :src="getCurrencyFlag(total.currency)" alt="Currency Flag">
            <h4>{{ total.currency }}</h4>
            <h4>{{ total.total }}</h4>
          </div>
        </div>
      </div>

      <div class="flex flex-col flex-grow w-full gap-4 mt-8">
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Total of Transactions'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <span class="text-2xl">
              {{ totalTransactions }}
            </span>
          </Dash>
          <Dash 
            :dash-title="'Total Value of Transactions'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <span class="text-2xl">
              {{ totalWithExchange }}
            </span>
          </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Average Ticket'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <span class="text-2xl">
              {{ Math.round(totalWithExchange / totalTransactions) }}
            </span>
          </Dash>
          <Dash 
            :dash-title="'Goal Achieved'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <span class="text-2xl">
              8%
            </span>
          </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Total of Transactions per Payment Method'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <ul class="flex flex-row gap-2">
              <li v-for="(total, method) in totalsByPaymentMethods" :key="method">
                {{ getPaymentMethodName(method) }}: {{ total }}
              </li>
            </ul>
          </Dash>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
