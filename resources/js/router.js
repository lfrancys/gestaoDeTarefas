// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import StatusIndex from "../components/Status/StatusIndex.vue";
import StatusForm from "../components/Status/StatusForm.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/statuses',
        name: 'StatusIndex',
        component: StatusIndex
    },
    {
        path: '/statuses/create',
        name: 'StatusCreate',
        component: StatusForm
    },
    {
        path: '/statuses/edit/:id',
        name: 'StatusEdit',
        component: StatusForm
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
