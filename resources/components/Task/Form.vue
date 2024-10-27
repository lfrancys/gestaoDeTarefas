<template>
    <div class="container">
        <h1>{{ isEditMode ? 'Editar Tarefa' : 'Nova Tarefa' }}</h1>
        <div v-if="error" class="lead">{{ error }}</div>
        <form @submit.prevent="submitForm">
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="title">Título:</label>
                    <input type="text" v-model="task.title" id="title" class="form-control" required />
                </div>
                <div class="form-group col-md-4">
                    <label for="status_id">Status:</label>
                    <select :disabled="selectDisabled" v-model="task.status_id" id="status_id" class="form-control" required>
                        <option v-for="status in statuses" :key="status.id" :value="status.id">
                            {{ status.description }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="user_id">Usuário:</label>
                    <select v-model="task.user_id" id="user_id" class="form-control" required>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="due_date">Data de Vencimento:</label>
                    <input
                        type="date"
                        v-model="task.due_date"
                        id="due_date"
                        class="form-control"
                        :min="today"
                        required
                    />
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
                user_id: null,
            },
            statuses: [],
            users: [],
            selectDisabled: false
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
        this.fetchUsers();
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

                if (!this.isEditMode) {
                    this.statuses = this.statuses.filter(status => status.name === 'pending');
                    this.task.status_id = this.statuses.length > 0 ? this.statuses[0].id : null;
                    this.selectDisabled = true;
                }

            } catch (err) {
                this.error = err.message;
            }
        },
        async fetchUsers() {
            try {
                const response = await fetch('/api/users');
                if (!response.ok) {
                    throw new Error('Erro ao buscar os usuários');
                }
                this.users = await response.json();
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

                // Se houver status definido no banco, o id será selecionado automaticamente
                console.log(this.task);
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
