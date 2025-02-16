<template>
    <div>
      <h1>Your Orders</h1>
      <table>
        <thead>
          <tr>
            <th>Customer</th>
            <th>Book</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <td>{{ order.customer_name }}</td>
            <td>{{ order.book.title }}</td>
            <td>{{ order.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      orders: Array,
    },
  };
  </script>
  