<template>
  <Navegador/>
  <div id="loginNav">
    <input v-model="email" type="text" id="email" name="email" placeholder="email" required>
    <input v-model="contrasena" type="password" id="pwd" name="contrasena" placeholder="contraseña" required> 
    <button class="btn btn-dark" type="submit" id="loginBtn" @click="login()">Login</button><br>
    <button><RouterLink to="/" id="inicio" class="btn btn-outline-primary">Volver a la pagina de inicio</RouterLink></button>
  </div>
</template>

<script>
  import Navegador from './Navegador.vue';
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  export default {
    data() {
        return {
            email: "",
            contrasena: "",
            datos: "",
            logueado: false,
            id_user: 0
        };
    },
    computed: {
      ...mapStores(sessioStore)
    },
    methods: {
        login() {
            console.log(this.email + " " + this.contrasena + " ");
            const datosEnvio = new FormData();
            datosEnvio.append("email", this.email);
            datosEnvio.append("contrasena", this.contrasena);
            fetch("http://localhost:8000/usuarios/login", {
                method: "POST",
                body: datosEnvio
            }).then(response => response.json())
                .then(data => this.datos = data);
            console.log(this.datos);
            if (this.datos != false) {
                this.logueado = true;
                this.id = this.datos;
                this.sessioStore.set({id_user: this.id, estado: this.logueado, email: this.email });
            }
        },
    },
    components: { Navegador }
}
</script>

<style>
  #email, #pwd {
    margin-right: 50px;
  }
  #loginBtn {
    margin-right: 20px;
  }
</style>