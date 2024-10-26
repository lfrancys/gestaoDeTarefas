import { createRouter, createWebHistory } from 'vue-router';
import App from "../components/App.vue";

// import TaskIndex from './components/TaskIndex.vue'; // Exemplo de componente de gerenciamento de tarefas
// import StatusIndex from './components/StatusIndex.vue'; // Exemplo de componente de gerenciamento de status

const routes = [
    { path: '/', name: 'home', component: App },
    // { path: '/tasks', name: 'tasks.index', component: TaskIndex },
    // { path: '/statuses', name: 'statuses.index', component: StatusIndex },
    // Adicione suas outras rotas aqui
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
