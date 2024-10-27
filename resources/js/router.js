// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import StatusIndex from "../components/Status/Index.vue";
import StatusForm from "../components/Status/Form.vue";
import TaskIndex from "../components/Task/Index.vue";
import TaskForm from "../components/Task/Form.vue";
import UserIndex from '../components/User/Index.vue';
import UserForm from '../components/User/Form.vue';

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
    {
        path: '/tasks',
        name: 'TaskIndex',
        component: TaskIndex
    },
    {
        path: '/tasks/create',
        name: 'TaskCreate',
        component: TaskForm
    },
    {
        path: '/tasks/edit/:id',
        name: 'TaskEdit',
        component: TaskForm
    },
    {
        path: '/users',
        name: 'UserIndex',
        component: UserIndex,
    },
    {
        path: '/users/create',
        name: 'UserCreate',
        component: UserForm,
    },
    {
        path: '/users/edit/:id',
        name: 'UserEdit',
        component: UserForm,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
