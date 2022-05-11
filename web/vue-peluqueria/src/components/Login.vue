<template>
  <div id="loginNav">
    <input v-model="email" type="text" id="email" name="email" placeholder="email" required>
    <input v-model="contrasena" type="password" id="pwd" name="contrasena" placeholder="contraseña" required> 
    <button class="btn btn-outline-primary" type="submit" id="loginBtn" @click="login()">Login</button><br> 
    <a class="btn btn-outline-primary" :href="'/perfil/' + this.datos">Perfil</a>
  </div>
</template>

<script>
  export default {
    data() {
      return {
          email: '',
          contrasena: '',
          datos: '',
      }
    },
    methods: {
      login() {
        console.log(this.email+ " " +  this.contrasena + " ");
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('contrasena', this.contrasena); 
        
        fetch('http://192.168.210.154:8000/usuarios/login', {
        method: 'POST',
        body: datosEnvio
        }).then(response => response.json())
        .then(data => this.datos = data);
        console.log(this.datos);
      },
    },
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