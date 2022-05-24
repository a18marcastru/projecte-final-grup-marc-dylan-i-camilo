<template>
  <Navegador/>
  <div class="regist-cont">
    <div id="registro">
      <h1>Registrar</h1>
      <h3 style="color: white;">Pon tus datos</h3><hr>
        <input  v-model="nombre" type="text" placeholder="Nombre" name="nombre" id="nombre"><br><br>
        <input v-model="apellido" type="text" placeholder="Apellido" name="apellido" id="apellido"><br><br>
        <input v-model="telefono" type="text" placeholder="Telefono" name="telefono" id="telefono"><br><br>
        <input v-model="email" type="text" placeholder="Email" name="email" id="email-reg"><br><br>
        <input v-model="contrasena" type="password" placeholder="Contraseña" name="contrasena" id="contrasena"><br><br>
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
            datos: "",
            nombre: "",
            apellido: "",
            telefono: "",
            email: "",
            contrasena: "",
        };
    },
    methods: {
        regist() {
            if(this.nombre != "" && this.apellido != "" && this.telefono != "" && this.email && this.contrasena !="") {
                let num = 0;
                let num2 = 0;
                let num3 = 0;

                var letras="ABCDEFGHYJKLMNÑOPQRSTUVWXYZabcdefghyjklmnñopqrstuvwxyz";
                for(let i = 0;i < this.nombre.length; i++){
                    if (letras.indexOf(this.nombre.charAt(i),0)!=-1){
                        num = 1;
                    }
                    else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Nombre',
                            text: 'El nombre tiene que tener palabras tanto mayusculas como minusculas.'
                        });
                    }
                }

                var letras="ABCDEFGHYJKLMNÑOPQRSTUVWXYZabcdefghyjklmnñopqrstuvwxyz";
                for(let i = 0;i < this.apellido.length; i++){
                    if (letras.indexOf(this.apellido.charAt(i),0)!=-1){
                        num2 = 1;
                    }
                    else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Apellido',
                            text: 'El apellido tiene que tener palabras tanto mayusculas como minusculas.'
                        });
                    }
                }

                var numeros = "0123456789";
                for(let i=0;i < this.telefono.length; i++){
                    if (numeros.indexOf(this.telefono.charAt(i),0)!=-1){
                        num3 = 1;
                    }
                    else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Telefono',
                            text: 'El telefono tiene que ser numeros.'
                        });
                    }
                }
                if(num != 0 && num2 != 0 && num3 != 0) {
                    const datosEnvio = new FormData();
                    datosEnvio.append("nombre", this.nombre);
                    datosEnvio.append("apellido", this.apellido);
                    datosEnvio.append("telefono", this.telefono);
                    datosEnvio.append("email", this.email);
                    datosEnvio.append("contrasena", this.contrasena);
                    fetch("http://peluqueriahappyback.alumnes.inspedralbes.cat/usuarios/nuevo/usuario", {
                        method: "POST",
                        body: datosEnvio
                    }).then(response => response.json())
                    .then(data => this.datos = data);
                    console.log(this.datos);
                    if(this.datos == "Bienvenido" && this.datos != "") {
                        Swal.fire({
                            icon: "success",
                            title: `Bienvenido a nuestra peluqueria ${this.nombre} ${this.apellido}`,
                        });
                        document.getElementById("inicio").removeAttribute("hidden");
                        document.getElementById("registro").setAttribute("style","display: none;");
                    }
                    else if(this.datos == "Existe un usuario" && this.datos != "") {
                        Swal.fire({
                            icon: "error",
                            title: 'Registro',
                            text: 'Ya existe un usuario con ese correo'
                        });
                    }
                }
            }
            else {
                Swal.fire({
                    icon: "error",
                    title: 'Formulario',
                    text: 'Es necesario completar los campos.'
                });
            }
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
</style>