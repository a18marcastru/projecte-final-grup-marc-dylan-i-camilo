<template>
  <Navegador/>
  <div>
    <div id="registro">
      <h1>Registrar</h1>
      <p>Pon tus datos</p><hr>
      <label for="nombre"><b>Nombre</b></label>
      <input  v-model="nombre" type="text" placeholder="Nombre" name="nombre" id="nombre" required><br><br>
      <label for="apellido"><b>Apellido</b></label>
      <input v-model="apellido" type="text" placeholder="Apellido" name="apellido" id="apellido" required><br><br>
      <label for="telefono"><b>Telefono</b></label>
      <input v-model="telefono" type="text" placeholder="Telefono" name="telefono" id="telefono" required><br><br>
      <label for="email"><b>Email</b></label>
      <input v-model="email" type="text" placeholder="Email" name="email" id="email" required><br><br>
      <label for="contrasena"><b>Contraseña</b></label>
      <input v-model="contrasena" type="text" placeholder="Contraseña" name="contrasena" id="contrasena" required><br><br>
      <button @click="regist()">Register</button><hr>
    </div>
  </div>
</template>

<script>
import Navegador from './Navegador.vue';
    export default {
    data() {
        return {
            nombre: "",
            apellido: "",
            telefono: "",
            email: "",
            contrasena: "",
        };
    },
    methods: {
        regist() {
            console.log(this.nombre + " " + this.apellido + " " + this.telefono + " " + this.email + " " + this.contrasena + " ");
            const datosEnvio = new FormData();
            datosEnvio.append("nombre", this.nombre);
            datosEnvio.append("apellido", this.apellido);
            datosEnvio.append("telefono", this.telefono);
            datosEnvio.append("email", this.email);
            datosEnvio.append("contrasena", this.contrasena);
            fetch("http://192.168.210.154:8000/usuarios/nuevo/usuario", {
                method: "POST",
                body: datosEnvio
            }).then(function (res) {
                return res.json();
            }).then(function (data) {
                console.log(data);
            });
        },
    },
    components: { Navegador }
}
</script>