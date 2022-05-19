<template>
  <div id="container">
    <div id="loginNav">
      <h1>Iniciar Sesion</h1>
      <input v-model="email" type="text" id="email" name="email" placeholder="email" required>
      <br><br>
      <input v-model="contrasena" type="password" id="pwd" name="contrasena" placeholder="contraseña" required>
      <br><br>
      <button class="btn btn-outline-primary" type="submit" id="loginBtn" @click="login()">Login</button>
      <RouterLink to="/" id="inicio" class="btn btn-outline-primary" hidden>Volver a la pagina de inicio</RouterLink>
    </div>
  </div>
  <br><br>
</template>

<script>
  import { RouterLink, RouterView } from "vue-router";
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  export default {
    data() {
      return {
          email: '',
          contrasena: '',
          datos: '',
          logueado: false,
          id_user: 0
      }
    },
    computed: {
      ...mapStores(sessioStore)
    },
    methods: {
      login() {
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('contrasena', this.contrasena); 
        
        fetch('http://192.168.210.154:8000/usuarios/login', {
        method: 'POST',
        body: datosEnvio
        }).then(response => response.json())
        .then(data => this.datos = data);
        console.log(this.datos);
        if(this.datos != false) {
          this.logueado = true;
          this.id = this.datos;
          this.sessioStore.set({id_user: this.id, estado: this.logueado, email: this.email});
          document.getElementById("loginBtn").setAttribute("style","display: none;");
          document.getElementById("inicio").removeAttribute("hidden");
        }
      },
    },
  }
</script>

<style>
  #email, #pwd {
    margin: 10px;
  }
  #loginNav {
    display: grid;
    justify-content: center;
    border: 2px solid black;
    margin-right: 30%;
    margin-left: 30%;
  }
</style>