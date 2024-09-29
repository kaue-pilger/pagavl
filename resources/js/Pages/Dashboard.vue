<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Dash from '@/Components/Dash.vue';

  import { Head } from '@inertiajs/vue3';
  import { ref, onMounted } from 'vue';

  import axios from 'axios';

  const totalsByCurrencies = ref([]);
  const totalsByPaymentMethods = ref([]);
  const totalTransactions = ref(0);
  const total = ref(0);
  const totalWithExchange = ref(0);
  const exchangeRates = ref(1);
  const currencyToExchange = ref('EUR');
  const isLoading = ref(true);

const handleCurrencyChange = async (event) => {
  currencyToExchange.value = event.target.value;

  try {
    const exchangeResponse = await axios.get(`https://v6.exchangerate-api.com/v6/ddd4f713411ae86b769edb54/latest/${currencyToExchange.value}`);
    exchangeRates.value = exchangeResponse.data.conversion_rates
    
    calculateTotalWithExchange(totalsByCurrencies);
  } catch (error) {
    console.error('Error trying to get API response on currency update:', error);
  } finally {
    isLoading.value = false;
  }
};

  const calculateTotal = () => {
    totalTransactions.value = Object.values(totalsByPaymentMethods.value).reduce((accumulator, currentValue) => {
      return accumulator + currentValue;
    }, 0);
  };

  const calculateTotalWithExchange = (currenciesArray) => {
    total.value = 0; // Reset the total before each calculation

    currenciesArray.value.forEach((currencyObj) => {
      // When we try to access a dinamic value in a Object we have to use [] intead .
      total.value += (parseInt(currencyObj.total) / exchangeRates.value[currencyObj.currency]); // Access the Object value with .value
    });

    totalWithExchange.value = total.value
  };

  const paymentMethodNames = {
    "1": "Credit Card",
    "2": "Debit Card",
    "3": "PIX"
  };

  const currencyFlags = {
    "EUR": "https://flagpedia.net/data/org/w580/eu.webp",
    "USD": "https://flagpedia.net/data/flags/w580/us.webp",
    "BRL": "https://flagpedia.net/data/flags/w580/br.webp"
  };

  const getPaymentMethodName = (method) => {
    return paymentMethodNames[method] || "Unknown Method";
  };

  const getCurrencyFlag = (currency) => {
    return currencyFlags[currency] || "Unknown Currency";
  };

  onMounted(async () => {
    try {
      const [currenciesResponse, paymentMethodsResponse, exchangeResponse] = await Promise.all([
        axios.get('/api/transactions/by/currencies'),
        axios.get('/api/transactions/by/payment-methods'),
        axios.get(`https://v6.exchangerate-api.com/v6/ddd4f713411ae86b769edb54/latest/${currencyToExchange.value}`)
      ]);
      
      totalsByPaymentMethods.value = paymentMethodsResponse.data;
      calculateTotal();
      
      totalsByCurrencies.value = currenciesResponse.data;
      exchangeRates.value = exchangeResponse.data.conversion_rates;

      calculateTotalWithExchange(totalsByCurrencies);

    } catch (error) {
      console.error('Error trying to get API response:', error);
    } finally {
      isLoading.value = false;
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
        <div v-if="isLoading" class="flex flex-row gap-8 mt-2 animate-pulse">
          <div v-for="n in 3" :key="n" class="flex flex-row justify-center items-center gap-4">
            <div class="rounded-full bg-iron h-10 w-10"></div>
            <div class="rounded-xl bg-iron h-8 w-32" />
          </div>
        </div>
        <div v-else class="flex flex-row gap-8 mt-2">
          <div class="flex flex-row justify-center items-center text-center gap-4" v-for="(totalByCurrency, index) in totalsByCurrencies" :key="index">
            <img class="h-10 w-10 rounded-full" :src="getCurrencyFlag(totalByCurrency.currency)" alt="Currency Flag">
            <h4>{{ totalByCurrency.currency }}</h4>
            <h4>{{ totalByCurrency.total }}</h4>
          </div>
        </div>
      </div>

      <div class="flex flex-col flex-grow w-full gap-4 mt-8">
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Total of Transactions'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <div v-if="isLoading" class="animate-pulse">
              <div class="h-8 bg-iron rounded-xl w-full" />
            </div>
            <span v-else class="text-2xl">
              {{ totalTransactions }}
            </span>
          </Dash>
          <Dash 
            :dash-title="'Total Value of Transactions in ' + currencyToExchange"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <div v-if="isLoading" class="animate-pulse">
              <div class="h-8 bg-iron rounded-xl w-full" />
            </div>
            <div v-else class="flex flex-row gap-4">              
              <span class="text-2xl">
                {{ totalWithExchange.toFixed(2) }}
              </span>
              <select name="currency" @change="handleCurrencyChange" class="rounded-full border-none focus:ring focus:ring-algae-gree">
                <option value="" selected="selected"></option>
                <option 
                  v-for="(totalByCurrency, index) in totalsByCurrencies" 
                  :key="index"
                  :value="totalByCurrency.currency"
                > 
                  {{ totalByCurrency.currency }} 
                </option>
              </select>
            </div>
          </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Average Ticket in ' + currencyToExchange"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <div v-if="isLoading" class="animate-pulse">
              <div class="h-8 bg-iron rounded-xl w-full" />
            </div>
            <span v-else class="text-2xl">
              {{ (totalWithExchange / totalTransactions).toFixed(2) }}
            </span>
          </Dash>
          <Dash 
            :dash-title="'Goal Achieved'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <div v-if="isLoading" class="animate-pulse">
              <div class="h-8 bg-iron rounded-xl w-full" />
            </div>
            <span v-else class="text-2xl">
              8%
            </span>
          </Dash>
        </div>
        <div class="flex flex-row w-full gap-4">
          <Dash 
            :dash-title="'Total of Transactions per Payment Method'"
            :dash-subtitle="'Lorem ipsum dolorrem ipsum um dolor.'"
          > 
            <div v-if="isLoading" class="animate-pulse">
              <div class="h-8 bg-iron rounded-xl w-full" />
            </div>
            <ul v-else class="flex flex-row gap-2">
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
