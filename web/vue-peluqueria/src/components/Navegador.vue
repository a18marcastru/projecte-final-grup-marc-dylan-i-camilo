<script>
    import { RouterLink, RouterView } from "vue-router";
    import { sessioStore } from '@/stores/sessioStore';
    import { mapStores } from 'pinia';
    export default {
        methods: {
            logout() {
                this.estado = false;
                this.sessioStore.set({id_user: "", estado: "", email: ""});
            }
        },
        computed: {
            ...mapStores(sessioStore)
        },
        beforeMount() {
            this.email = this.sessioStore.get.email;
            this.id = this.sessioStore.get.id_user;
            this.estado = this.sessioStore.get.estado;
            console.log(this.estado);
        }
    }
</script>

<template>
    <header>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <RouterLink class="btn btn-outline-primary" to="/">Home</RouterLink>
            <RouterLink class="btn btn-outline-primary" to="/tienda">tienda</RouterLink>
            <RouterLink class="btn btn-outline-primary" to="/reserva">Reserva</RouterLink>
            <form v-if="this.estado == true">
                <a class="btn btn-outline-primary"  :href="'/perfil/' + this.id" id="login">Perfil</a>
                <button class="btn btn-outline-primary" @click="logout()">Logout</button>
            </form>
            <form v-else>
                <RouterLink class="btn btn-outline-primary" to="/register">Registro</RouterLink>
                <RouterLink class="btn btn-outline-primary" to="/login">Login</RouterLink>
            </form>
        </nav>
    </header>
</template>