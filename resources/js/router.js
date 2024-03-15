import { createRouter, createWebHistory } from 'vue-router';

import Graphs from "./components/BdcomGraphs.vue";

const routes = [
    {
        path: "/netping/graphs/:bdcom_id/",
        name: "bdcom.graphs",
        props: true,
        component: Graphs,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
