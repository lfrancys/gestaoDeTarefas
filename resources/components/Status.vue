<template>
    <div class="status-page">
        <h1>Status do Sistema</h1>
        <div v-if="loading">Carregando...</div>
        <div v-else-if="error">{{ error }}</div>
        <div v-else>
            <h2>Lista de Status:</h2>
            <ul>
                <li v-for="status in statuses" :key="status.id">
                    {{ status.name }} - {{ status.description }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: true,
            error: null,
            statuses: [],
        };
    },
    mounted() {
        this.fetchStatuses();
    },
    methods: {
        async fetchStatuses() {
            try {
                const response = await fetch('/statuses'); // Usa a rota de recursos
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Erro ao buscar status');
                }
                this.statuses = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style scoped>
.status-page {
    padding: 20px;
}
</style>
