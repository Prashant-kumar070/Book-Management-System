<template>
  <div>
    <h1>Welcome, Author</h1>
    <div>
      <p>Books Count: {{ booksCount }}</p>
      <p>Orders Count: {{ ordersCount }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    booksCount: Number,
    ordersCount: Number,
  },
};
</script>
