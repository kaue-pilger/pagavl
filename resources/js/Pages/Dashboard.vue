<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Dash from '@/Components/Dash.vue';

  import { Head } from '@inertiajs/vue3';
  import { ref, onMounted } from 'vue';

  import axios from 'axios';

  const totalsByCurrency = ref([]);
  const totalsByPaymentMethods = ref([]);
  const amounts = ref([]);

  const totalTransactions = ref(0);

  const calculateTotal = () => {
    totalTransactions.value = Object.values(totalsByPaymentMethods.value).reduce((total, amount) => {
      return total + amount;
    }, 0);
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

  onMounted(() => {
    axios.get('/api/transactions/by-currency')
      .then(response => {
        totalsByCurrency.value = response.data;
      })
      .catch(error => {
        console.error('Error trying to get API response:', error);
      });

    axios.get('/api/transactions/by-payment-methods')
      .then(response => {
        totalsByPaymentMethods.value = response.data;

        calculateTotal()
      })
      .catch(error => {
        console.error('Error trying to get API response:', error);
      });

    axios.get('/api/transactions/all-amounts')
      .then(response => {
        amounts.value = response.data.map(item => item.amounts);
      })
      .catch(error => {
        console.error('Error trying to get API response:', error);
      });
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
            :dash-title="'Total Amount of Transactions'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <ul>
              <li class="text-2xl" v-for="(amount, index) in amounts" :key="index">
                {{ amount }}
              </li>
            </ul>
          </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Average Ticket'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <span class="text-2xl">
              {{ Math.round(amounts / totalTransactions) }}
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
