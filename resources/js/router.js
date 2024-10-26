// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Status from "../components/Status.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/statuses',
        name: 'Statuses',
        component: Status,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
