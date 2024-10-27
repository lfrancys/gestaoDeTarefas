<template>
    <div class="container">
        <h1>{{ isEditMode ? 'Editar Tarefa' : 'Nova Tarefa' }}</h1>
        <div v-if="error" class="lead">{{ error }}</div>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" v-model="task.title" id="title" class="form-control" required />
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="due_date">Data de Vencimento:</label>
                    <input
                        type="date"
                        v-model="task.due_date"
                        id="due_date"
                        class="form-control form-control-sm"
                        :min="today"
                        required
                    />
                </div>
                <div class="form-group col-md-6">
                    <label for="status_id">Status:</label>
                    <select v-model="task.status_id" id="status_id" class="form-control" required>
                        <option v-for="status in statuses" :key="status.id" :value="status.id">
                            {{ status.description }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label for="user_id">Usuário:</label>
                        <v-select
                            v-model="task.user_id"
                            :options="users"
                            label="name"
                            :filterable="true"
                            placeholder="Selecione um usuário"
                            id="user_id"
                            class="form-control"
                            required
                        ></v-select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea v-model="task.description" id="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="margin-top-10">
                <button type="submit" class="btn btn-primary btn-left">Salvar</button>
                <button type="button" @click="cancel" class="btn btn-secondary btn-left">Cancelar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "TaskForm",
    data() {
        return {
            loading: true,
            error: null,
            task: {
                title: '',
                description: '',
                due_date: '',
                status_id: null,
            },
            statuses: [],
        };
    },
    computed: {
        isEditMode() {
            return this.$route.name === 'TaskEdit';
        },
        today() {
            const date = new Date();
            return date.toISOString().split('T')[0];
        },
    },
    mounted() {
        this.fetchStatuses();
        if (this.isEditMode) {
            this.fetchTask();
        }
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
            }
        },
        async fetchTask() {
            const taskId = this.$route.params.id;
            try {
                const response = await fetch(`/api/tasks/${taskId}`);
                if (!response.ok) {
                    throw new Error('Erro ao buscar tarefa');
                }
                this.task = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        async submitForm() {
            const method = this.isEditMode ? 'PUT' : 'POST';
            const url = this.isEditMode ? `/api/tasks/${this.task.id}` : '/api/tasks';
            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.task),
                });
                if (!response.ok) {
                    throw new Error(this.isEditMode ? 'Erro ao atualizar tarefa' : 'Erro ao criar tarefa');
                }
                this.$router.push('/tasks');
            } catch (err) {
                this.error = err.message;
            }
        },
        cancel() {
            this.$router.push('/tasks');
        },
    },
};
</script>

<style scoped>
.container {
    padding: 40px;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
    text-align: left; /* Alinhamento dos labels à esquerda */
}

.form-row {
    display: flex;
    justify-content: space-between;
}

.text-right {
    text-align: right; /* Alinhamento dos botões à direita */
}
</style>
