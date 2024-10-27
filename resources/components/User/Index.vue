<template>
    <div class="user-container">
        <h1>Usuários</h1>
        <div class="d-flex justify-content-between mb-3">
            <router-link to="/" class="btn btn-secondary">
                <i class="fas fa-home"></i>
            </router-link>
            <router-link to="/users/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar
            </router-link>
        </div>
        <div v-if="loading" class="lead">Carregando...</div>
        <div v-else-if="error" class="lead">{{ error }}</div>
        <div v-else>
            <div v-if="users.length === 0" class="lead">Não há usuários cadastrados.</div>
            <table class="main-table" v-else>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="actions">
                        <router-link
                            :to="{ name: 'UserEdit', params: { id: user.id } }"
                            class="btn-first edit-button"
                            title="Editar">
                            <i class="fas fa-edit"></i>
                        </router-link>
                        <button @click="deleteUser(user.id)" class="btn-first delete-button" title="Apagar">
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
    name: "UserIndex",
    data() {
        return {
            loading: true,
            error: null,
            users: [],
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            try {
                const response = await fetch('/api/users');
                if (!response.ok) {
                    throw new Error('Erro ao buscar usuários');
                }
                this.users = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        async deleteUser(id) {
            if (confirm('Tem certeza de que deseja apagar esta usuário?')) {
                try {
                    const response = await fetch(`/api/users/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Erro ao apagar usuário');
                    }
                    this.users = this.users.filter(user => user.id !== id);
                } catch (err) {
                    this.error = err.message;
                }
            }
        },
    },
};
</script>

<style scoped>
.user-container {
    padding: 40px;
    text-align: center;
}
</style>
