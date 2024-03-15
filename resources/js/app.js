require('./bootstrap');
import 'flowbite';

import { createApp } from 'vue';
import Graph from './components/BdcomGraphs.vue'
import router from './router'

const app = createApp({});
app.component('graphs', Graph);

app.use(router);
app.mount("#app");
