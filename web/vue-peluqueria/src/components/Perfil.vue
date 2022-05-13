<template>
    <div id="perfil">
        <h1>Perfil del usuario {{$route.params.id}}</h1><br><br>
        <h3>Nombre: {{this.datos.nombre}}</h3><br>
        <h3>Apellido: {{this.datos.apellido}}</h3><br>
        <h3>Teléfono: {{this.datos.telefono}}</h3><br>
        <h3>Email: {{this.datos.email}}</h3><br><br>
        <h3>Cambiar contraseña:</h3>
        <input v-model="contrasena" type="password" id="pwd2" name="contrasena2" placeholder="introduce nueva contraseña" size="35" required><br><br><br>
        <button class="btn btn-outline-primary" type="submit" id="perfilBtn" @click="cambios()">Guardar cambios<br> {{this.datos.nombre}}</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                datos: [],
                nombre: '',
                apellido: '',
                telefono: '',
                email: '',
            }
        },
        methods: {
            cambios() {
                console.log(this.contrasena + " ");
                const datosEnvio = new FormData();
                datosEnvio.append('contrasena', this.contrasena);
            },
        },
        mounted() {
            console.log(this.$route.params.id);
            fetch(`http://192.168.210.154:8000/usuarios/perfil/${this.$route.params.id}`)
            .then(res => res.json())
            .then((data) => {
            this.datos = data;
            });
            console.log(this.datos);
        }
    }            
</script>

<style>
    
</style>