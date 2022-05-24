<template>
  <Navegador/>
  <div class="regist-cont">
    <div id="registro">
      <h1>Registrar</h1>
      <h3 style="color: white;">Pon tus datos</h3><hr>
        <input  v-model="nombre" type="text" placeholder="Nombre" name="nombre" id="nombre" required><br><br>
        <input v-model="apellido" type="text" placeholder="Apellido" name="apellido" id="apellido" required><br><br>
        <input v-model="telefono" type="text" placeholder="Telefono" name="telefono" id="telefono" required><br><br>
        <input v-model="email" type="text" placeholder="Email" name="email" id="email-reg" required><br><br>
        <input v-model="contrasena" type="password" placeholder="Contraseña" name="contrasena" id="contrasena" required><br><br>
        <button class="btn btn-dark" @click="regist()">Register</button><hr>
    </div>
    <div id="inicio" hidden>
      <RouterLink to="/" class="btn btn-dark">Volver a la pagina de inicio</RouterLink>
    </div>
  </div>
</template>

<script>
    import Swal from 'sweetalert2';
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
                console.log(data)
            });
            Swal.fire({
                title: `Bienvenido a nuestra peluqueria ${this.nombre} ${this.apellido}`,
            });
            document.getElementById("inicio").removeAttribute("hidden");
            document.getElementById("registro").setAttribute("style","display: none;");
        },
    },
    components: { Navegador }
}
</script>

<style>
    .regist-cont {
        justify-content: center;
        align-items: center;
        height: 65vh;
        display: flex;
        margin-left: 0px;
    }
    #registro {
        background-color: black;
        border-radius: 20px;
        box-sizing: border-box;
        height: 500px;
        padding: 20px;
        width: 320px;
        color: white;
        margin-left: 0px;
        text-align: center;
    }
    #inicio {
        border: 1px solid black;
        border-radius: 5px;
        padding: 20px;
        background-color: black;
    }
</style>