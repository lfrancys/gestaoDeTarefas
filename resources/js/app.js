import { createApp } from 'vue';
import router from './router';
import App from "../components/App.vue"


const app = createApp(App);
app.use(router);
app.component('Home', App);
app.mount('#app');
