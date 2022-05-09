<template>
    <h1>Perfil de Usuario</h1>
    <div id="perfil">
        <p>{{this.nombre}}</p>
    </div>
    <button @click="datos()">Tus datos pesonales</button>
</template>

<script>
    export default {
        data() {
            return {
                nombre: '',
                apellido: '',
                telefono: '',
                email: '',
                contrasena: '',
                datos: '',
            }
        },
        methods: {
            datos() {
                console.log(this.nombre + " " + this.apellido + " " + this.telefono + " " + this.email+ " " +  this.contrasena + " ");
                const datosEnvio = new FormData();
                datosEnvio.append('nombre', this.nombre);
                datosEnvio.append('apellido', this.apellido);
                datosEnvio.append('telefono', this.telefono);
                datosEnvio.append('email', this.email);
                datosEnvio.append('contrasena', this.contrasena);

                fetch('http://192.168.210.153:8000/usuarios/nuevo/usuario', {
                method: 'POST',
                body: datosEnvio
                }).then(response => response.json())
                .then(data => this.datos = data);
            },  
        }
    }   
</script>