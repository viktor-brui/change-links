import './bootstrap';
import { createApp } from 'vue';
import MainPage from './components/MainPage.vue';
import PageNotFound from './components/PageNotFound.vue';

const app = createApp({});

app.component('main-page', MainPage);
app.component('page-not-found', PageNotFound);
app.mount('#app');
