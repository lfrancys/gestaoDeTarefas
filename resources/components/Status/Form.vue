<template>
    <div class="container">
        <h1>{{ isEditMode ? 'Editar Status' : 'Criar Novo Status' }}</h1>
        <form @submit.prevent="saveStatus">
            <div class="form-group">
                <label for="name">Nome</label>
                <input
                    type="text"
                    id="name"
                    v-model="status.name"
                    class="form-control"
                    required
                />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input
                    type="text"
                    id="name"
                    v-model="status.description"
                    class="form-control"
                    required
                />
            </div>
            <div class="margin-top-10">
                <button type="submit" class="btn btn-primary btn-left">Salvar</button>
                <button type="button" @click="cancel" class="btn btn-secondary btn-left">Cancelar</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "StatusForm",
    data() {
        return {
            status: {
                name: '',
                description: '',
            },
            isEditMode: false,
        };
    },
    created() {
        const id = this.$route.params.id;
        if (id) {
            this.isEditMode = true;
            this.fetchStatus(id);
        }
    },
    methods: {
        async fetchStatus(id) {
            try {
                const response = await axios.get(`/api/statuses/${id}`);
                this.status = response.data;
            } catch (error) {
                console.error('Erro ao buscar status:', error);
            }
        },
        async saveStatus() {
            try {
                if (this.isEditMode) {
                    console.log(this.status);

                    const id = this.$route.params.id;
                    await axios.put(`/api/statuses/${id}`, this.status);
                } else {
                    await axios.post('/api/statuses', this.status);
                }
                this.$router.push({ name: 'StatusIndex' });
            } catch (error) {
                console.error('Erro ao salvar status:', error);
            }
        },
        cancel() {
            this.$router.push('/statuses');
        },
    },
};
</script>

<style scoped>
/* Adicione estilos aqui, se necessário */
</style>
