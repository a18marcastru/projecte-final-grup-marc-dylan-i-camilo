<template>
    <div>
   <h1>Registrar</h1>
    <p>Pon tus datos</p>
    <hr>
     <label for="nombre"><b>Nombre</b></label>
    <input  v-model="nombre" type="text" placeholder="Nombre" name="nombre" id="nombre" required>
    <br>
    <br>
      <label for="apellido"><b>Apellido</b></label>
    <input v-model="apellido" type="text" placeholder="Apellido" name="apellido" id="apellido" required>
    <br>
    <br>

     <label for="telefono"><b>Telefono</b></label>
    <input v-model="email" type="text" placeholder="Telefono" name="telefono" id="telefono" required>
    <br>
    <br>

    <label for="email"><b>Email</b></label>
    <input v-model="email" type="text" placeholder="Email" name="email" id="email" required>
    <br>
    <br>
  <label for="contra"><b>Contraseña</b></label>
    <input v-model="email" type="text" placeholder="Contraseña" name="contrasena" id="contrasena" required>
    <br>
    <br>


    <button @click="regist()">Register</button>
    
    <hr>
  </div>



</template>

<script>
    export default {
        data() {
            return {
                nombre: '',
                apellido: '',
                email: '',
                contrasena: ''
            }
        },
        methods: {
            regist() {
                console.log(this.nombre + " " + this.apellido + " " + this.email + " " + this.butacas+ " " +  this.fecha + " " +  this.precio_total + " " +  this.id_sesion + " " );
                const datosEnvio = new FormData();
                datosEnvio.append('nombre', this.nombre);
                datosEnvio.append('apellido', this.apellido);
                datosEnvio.append('email', this.email);
                datosEnvio.append('butacas', this.butacas);
                datosEnvio.append('fecha', this.fecha);
                datosEnvio.append('precio_total', this.precio_total);
                datosEnvio.append('id_sesion', this.id_sesion);


                fetch('http://cinema6back.alumnes.inspedralbes.cat/usuarios', {
                  method: 'POST',
                  body: datosEnvio
                }).then(function(res){
                  return res.json();
                }).then(function(data){
                  console.log(data)
                });
            },
        },
    }
</script> 