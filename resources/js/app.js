import './bootstrap';

import Alpine from 'alpinejs';
import Dashboard from './components/Author/Dashboard.vue';
import Orders from './components/Author/Orders.vue';
// import Books from './components/Author/Books.vue';
window.Alpine = Alpine;

Alpine.start();

const app = createApp({});

app.component('dashboard', Dashboard);
app.component('orders', Orders);
// app.component('books', Books);

app.mount('#app');
