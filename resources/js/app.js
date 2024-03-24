import './bootstrap';
import { createApp } from 'vue';
import router from "./router";
import Index from './views/Index.vue';



const app = createApp({});

app.use(router);

app.component("index", Index);
app.mount('#app');
