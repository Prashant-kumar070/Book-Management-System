<template>
    <div>
      <h1>Your Books</h1>
      <div>
        <button @click="showAddBookForm = !showAddBookForm">Add New Book</button>
        <div v-if="showAddBookForm">
          <form @submit.prevent="addBook">
            <input v-model="newBook.title" type="text" placeholder="Title" />
            <textarea v-model="newBook.description" placeholder="Description"></textarea>
            <input v-model="newBook.price" type="number" placeholder="Price" />
            <button type="submit">Add Book</button>
          </form>
        </div>
      </div>
  
      <ul>
        <li v-for="book in books" :key="book.id">
          {{ book.title }} - ${{ book.price }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showAddBookForm: false,
        newBook: {
          title: '',
          description: '',
          price: '',
        },
        books: [],
      };
    },
    methods: {
      addBook() {
        // Make API call to store the new book
        axios
          .post('/author/books', this.newBook)
          .then(() => {
            this.books.push(this.newBook); // Update the local books list
            this.newBook = { title: '', description: '', price: '' };
          });
      },
    },
  };
  </script>
  