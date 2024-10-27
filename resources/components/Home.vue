<template>
    <div class="home-container">
        <h1>Bem-vindo ao Sistema de Gerenciamento de Tarefas</h1>
        <p class="lead">Gerencie suas tarefas e status de forma simples e eficiente.</p>
        <div class="cards-container">
            <div class="card" v-for="(link, index) in links" :key="index">
                <div class="icon">{{ link.icon }}</div>
                <h2 class="title">{{ link.title }}</h2>
                <p class="details">{{ link.description }}</p>
                <div class="button-container">
                    <router-link :to="link.route" class="btn btn-primary">
                        Acessar {{ link.buttonText }}
                    </router-link>
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
                    title: 'Tarefas',
                    description: 'Visualizar, criar, editar e excluir suas tarefas.',
                    buttonText: 'Tarefas',
                    route: '/tasks',
                    icon: '📝',
                },
                {
                    title: 'Status',
                    description: 'Organize os status das suas tarefas facilmente.',
                    buttonText: 'Status',
                    route: '/statuses',
                    icon: '🚦',
                },
                {
                    title: 'Usuários',
                    description: 'Visualizar, criar, editar e excluir os usuários.',
                    buttonText: 'Usuários',
                    route: '/users',
                    icon: '🧑',
                },
                // {
                //     title: 'Relatórios',
                //     description: 'Visualize relatórios sobre suas tarefas e desempenho.',
                //     buttonText: 'Relatórios',
                //     route: '/relatorios',
                //     icon: '📊',
                // },
            ],
        };
    },
};
</script>

<style scoped>
.home-container {
    padding: 40px;
    text-align: center;
}

.cards-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 100px;
}

.card {
    background-color: rgba(37, 37, 37, 0.8);
    border-radius: 10px;
    padding: 30px;
    margin: 10px;
    width: 300px;
    color: #ffffff;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: #f39c12;
}

.title {
    font-size: 1.75rem;
    font-weight: 700;
}

.details {
    color: #d3d3d3;
    margin-top: 10px;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.btn {
    background-color: #0056b3;
    color: #ffffff;
    border-radius: 8px;
    padding: 10px 16px;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.2s;
}

.btn:hover {
    background-color: #007BFF;
    transform: scale(1.05);
}

.lead {
    font-size: 1.5rem;
    color: #e0e0e0;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .cards-container {
        flex-direction: column;
        align-items: center;
    }
    .card {
        width: 90%;
    }
}
</style>
