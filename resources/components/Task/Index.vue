<template>
    <div class="task-container">
        <h1>Tarefas</h1>
        <div class="d-flex justify-content-between mb-3">
            <router-link to="/" class="btn btn-secondary">
                <i class="fas fa-home"></i>
            </router-link>
            <router-link to="/tasks/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Tarefa
            </router-link>
        </div>
        <div v-if="loading" class="lead">Carregando...</div>
        <div v-else-if="error" class="lead">{{ error }}</div>
        <div v-else>
            <div v-if="tasks.length === 0" class="lead">Não há tarefas cadastradas.</div>
            <table class="main-table" v-else>
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                    <td class="actions">
                        <router-link
                            :to="{ name: 'TaskEdit', params: { id: task.id } }"
                            class="btn-first edit-button"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </router-link>
                        <button @click="deleteTask(task.id)" class="btn-first delete-button" title="Apagar">
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
    name: "TaskIndex",
    data() {
        return {
            loading: true,
            error: null,
            tasks: [],
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        async fetchTasks() {
            try {
                const response = await fetch('/api/tasks');
                if (!response.ok) {
                    throw new Error('Erro ao buscar tarefas');
                }
                this.tasks = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        async deleteTask(id) {
            if (confirm('Tem certeza de que deseja apagar esta tarefa?')) {
                try {
                    const response = await fetch(`/api/tasks/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Erro ao apagar tarefa');
                    }
                    this.tasks = this.tasks.filter(task => task.id !== id);
                } catch (err) {
                    this.error = err.message;
                }
            }
        },
    },
};
</script>

<style scoped>
.task-container {
    padding: 40px;
    text-align: center;
}
</style>
