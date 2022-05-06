<template>
  <div class="contForm">
    <h2>Login Form</h2>
    <div class="form">
      <label for="email"><b>Correo electrónico</b></label>
      <input v-model="email" type="text" id="email" name="email" required><br><br>
      <label for="contrasena"><b>Contraseña</b></label>
      <input v-model="contrasena" type="password" id="contrasena" name="contrasena" required><br><br>     
      <button type="submit" @click="login()">Login</button>
    </div><br>
    <p>id {{this.datos}}</p>
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
        console.log(this.email+ " " +  this.contrasena + " " );
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('contrasena', this.contrasena); 

        fetch('http://peluqueriahappyback.alumnes.inspedralbes.cat/usuarios/login', {
        method: 'POST',
        body: datosEnvio
        }).then(response => response.json())
        .then(data => this.datos = data);
      },
    },
  }
</script>