<script>
  export default {
    props: {
        transactions: Array,
    },
  };
</script>

<template>
  <div>
      <h2>Lista de Transações</h2>
      <table>
          <thead>
              <tr>
                  <th>ID</th>
                  <th>ID Merchant</th>
                  <th>ID Order</th>
                  <th>Amount</th>
                  <th>Currency</th>
                  <th>Payment Method</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="transaction in transactions" :key="transaction.id">
                  <td>{{ transaction.id }}</td>
                  <td>{{ transaction.merchant_id }}</td>
                  <td>{{ transaction.order_id }}</td>
                  <td>{{ transaction.amount }}</td>
                  <td>{{ transaction.currency }}</td>
                  <td>{{ transaction.payment_method }}</td>
                  <td>
                      <button @click="$emit('edit', transaction.id)">Editar</button>
                      <button @click="$emit('delete', transaction.id)">Excluir</button>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }
</style>
