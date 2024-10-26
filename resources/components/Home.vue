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
                    title: 'Gerenciar Tarefas',
                    description: 'Visualizar, criar, editar e excluir suas tarefas.',
                    buttonText: 'Tarefas',
                    route: '/tarefas',
                    icon: '📝', // Ícone para o card
                },
                {
                    title: 'Gerenciar Status',
                    description: 'Organize os status das suas tarefas facilmente.',
                    buttonText: 'Status',
                    route: '/statuses',
                    icon: '🚦', // Ícone para o card
                },
                {
                    title: 'Relatórios',
                    description: 'Visualize relatórios sobre suas tarefas e desempenho.',
                    buttonText: 'Relatórios',
                    route: '/relatorios',
                    icon: '📊', // Ícone para o card
                },
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
    background-color: rgba(37, 37, 37, 0.8); /* Fundo semi-transparente */
    border-radius: 10px;
    padding: 30px;
    margin: 10px;
    width: 300px;
    color: #ffffff;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); /* Sombra sutil */
    transition: transform 0.2s; /* Animação de transformação */
}

.card:hover {
    transform: translateY(-5px); /* Levanta o card ao passar o mouse */
}

.icon {
    font-size: 2.5rem; /* Tamanho do ícone */
    margin-bottom: 15px; /* Espaço abaixo do ícone */
    color: #f39c12; /* Cor do ícone */
}

.title {
    font-size: 1.75rem; /* Tamanho do título */
    font-weight: 700; /* Aumenta o peso da fonte */
}

.details {
    color: #d3d3d3; /* Cor do texto mais clara para contraste */
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
    transform: scale(1.05); /* Efeito de aumento no botão */
}

.lead {
    font-size: 1.5rem; /* Tamanho do texto */
    color: #e0e0e0;
    margin-bottom: 30px; /* Aumenta o espaço abaixo do parágrafo */
}

/* Responsividade */
@media (max-width: 768px) {
    .cards-container {
        flex-direction: column; /* Alinha os cards em coluna em telas menores */
        align-items: center; /* Centraliza os cards */
    }
    .card {
        width: 90%; /* Aumenta a largura em telas menores */
    }
}
</style>
