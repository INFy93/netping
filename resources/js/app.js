require('./bootstrap');
import 'flowbite';

import { createApp } from 'vue';
import Graph from './components/BdcomGraphs.vue'

const app = createApp({});
app.component('graphs', Graph);

app.mount("#app");
