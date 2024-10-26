<template>
    <div class="status-container">
        <h1>Status do Sistema</h1>
        <div v-if="loading" class="lead">Carregando...</div>
        <div v-else-if="error" class="lead">{{ error }}</div>
        <div v-else>
            <router-link to="/statuses/create" class="btn-first edit-button btn-left">
                <i class="fas fa-plus"></i> Novo
            </router-link>

            <table class="main-table">
                <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="status in statuses" :key="status.id">
                    <td>{{ status.description }}</td>
                    <td class="actions">
                        <router-link
                            :to="{ name: 'StatusEdit', params: { id: status.id } }"
                            class="btn-first edit-button"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </router-link>

                        <button @click="deleteStatus(status.id)" class="btn-first delete-button" title="Apagar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
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
                const response = await fetch('/api/statuses');
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
        async deleteStatus(id) {
            if (confirm('Tem certeza de que deseja apagar este status?')) {
                try {
                    const response = await fetch(`/api/statuses/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Erro ao apagar status');
                    }
                    this.statuses = this.statuses.filter(status => status.id !== id);
                } catch (err) {
                    this.error = err.message;
                }
            }
        },
    },
};
</script>

<style scoped>
.status-container {
    padding: 40px;
    text-align: center;
}
</style>
