<template>
    <div class="container">
        <h1>{{ isEditMode ? 'Editar Usuário' : 'Novo Usuário' }}</h1>
        <div v-if="error" class="lead">{{ error }}</div>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" v-model="user.name" id="name" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" v-model="user.email" id="email" class="form-control" required />
            </div>
            <div class="form-group" v-if="!isEditMode">
                <label for="password">Senha:</label>
                <input type="password" v-model="user.password" id="password" class="form-control" required />
            </div>
            <div class="form-group" v-else>
                <label for="password">Nova Senha (opcional):</label>
                <input type="password" v-model="user.password" id="password" class="form-control" />
            </div>
            <div class="margin-top-10 text-right">
                <button type="button" @click="cancel" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "UserForm",
    data() {
        return {
            error: null,
            user: {
                name: '',
                email: '',
                password: '',
            },
        };
    },
    computed: {
        isEditMode() {
            return this.$route.name === 'UserEdit';
        },
    },
    mounted() {
        if (this.isEditMode) {
            this.fetchUser();
        }
    },
    methods: {
        async fetchUser() {
            const userId = this.$route.params.id;
            try {
                const response = await fetch(`/api/users/${userId}`);
                if (!response.ok) {
                    throw new Error('Erro ao buscar usuário');
                }
                this.user = await response.json();
                this.user.password = '';
            } catch (err) {
                this.error = err.message;
            }
        },
        async submitForm() {
            console.log('cruiandooooo')
            const method = this.isEditMode ? 'PUT' : 'POST';
            const url = this.isEditMode ? `/api/users/${this.user.id}` : '/api/users';

            console.log(method)
            console.log(url)
            console.log(this.user)

            try {
                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.user),
                });
                if (!response.ok) {
                    console.log(response)
                    throw new Error(this.isEditMode ? 'Erro ao atualizar usuário' : 'Erro ao criar usuário');
                }
                this.$router.push('/users');
            } catch (err) {
                this.error = err.message;
            }
        },
        cancel() {
            this.$router.push('/users');
        }
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
    text-align: left;
}

.text-right {
    text-align: right;
}
</style>
