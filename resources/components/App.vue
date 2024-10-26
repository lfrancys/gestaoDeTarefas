<template>
    <div class="container mt-5 text-center">
        <h1 class="display-4">Bem-vindo ao Sistema de Gerenciamento de Tarefas</h1>
        <p class="lead">Gerencie suas tarefas e status de forma simples e eficiente.</p>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-4 mb-4" v-for="(link, index) in links" :key="index">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ link.title }}</h5>
                        <p class="card-text">{{ link.description }}</p>
                        <router-link :to="link.route" class="btn" :class="link.buttonClass">Ir para {{ link.buttonText }}</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: [
                {
                    title: 'Gerenciar Tarefas',
                    description: 'Visualizar, criar, editar e excluir suas tarefas.',
                    // route: { name: 'tasks.index' },
                    buttonText: 'Tarefas',
                    buttonClass: 'btn-primary',
                },
                {
                    title: 'Gerenciar Status',
                    description: 'Organize os status das suas tarefas facilmente.',
                    // route: { name: 'statuses.index' },
                    buttonText: 'Status',
                    buttonClass: 'btn-success',
                },
                {
                    title: 'Relatórios',
                    description: 'Visualize relatórios sobre suas tarefas e desempenho.',
                    // route: { name: 'reports.index' }, // Substitua pelo nome da rota de relatórios
                    buttonText: 'Relatórios',
                    buttonClass: 'btn-info',
                },
            ],
        };
    },
};
</script>

<style scoped>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.btn {
    width: 100%;
}
</style>
