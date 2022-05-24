<template>
    <header>
        <nav class="navbar navbar-dark bg-dark" style="background-color: #e3f2fd;">
            <a href="/" id="logo_direccion"><img class="logo" alt="Logo" src="/logo.png"/></a>
            <div v-if="this.estado != true">
                <RouterLink class="btn btn-dark" to="/">Home</RouterLink>
                <RouterLink class="btn btn-dark" to="/tienda">Tienda</RouterLink>
                <RouterLink class="btn btn-dark" to="/reserva">Reserva</RouterLink>
                <RouterLink class="btn btn-dark" to="/register">Registro</RouterLink>
                <RouterLink class="btn btn-dark" to="/login">Login</RouterLink>
            </div>
            <div v-else>
                <RouterLink class="btn btn-dark" to="/">Home</RouterLink>
                <RouterLink class="btn btn-dark" to="/tienda">Tienda</RouterLink>
                <RouterLink class="btn btn-dark" to="/reserva">Reserva</RouterLink>
                <RouterLink class="btn btn-dark" :to="'/perfil/' + this.id_user">Perfil</RouterLink>
                <button class="btn btn-dark" @click="logout()">Logout</button>
            </div>
        </nav>
    </header>
</template>

<script>
    import { RouterLink, RouterView } from "vue-router";
    import { sessioStore } from '@/stores/sessioStore';
    import { mapStores } from 'pinia';
    export default {
        data() {
            return {
                estado: false,
                id_user: ''
            }
        },
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
            this.id_user = this.sessioStore.get.id_user;
            this.estado = this.sessioStore.get.estado;
            console.log(this.id_user);
        }
    }
</script>