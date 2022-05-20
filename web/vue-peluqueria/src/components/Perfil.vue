<template>
    <div id="perfil">
        <div id="datos">
            <h2>Perfil del usuario</h2><br><br>
            <p>Nombre: {{this.datos.nombre}}</p><br>
            <p>Apellido: {{this.datos.apellido}}</p><br>
            <p>Teléfono: {{this.datos.telefono}}</p><br>
            <p>Email: {{this.datos.email}}</p><br><br>
        </div>
        <div id="contrasena">
            <h2>Cambiar contraseña:</h2>
            <input v-model="contrasena" type="password" id="pwd2" name="contrasena2" placeholder="introduce nueva contraseña" size="35" required><br><br>
            <button class="btn btn-outline-primary" type="submit" id="perfilBtn" @click="cambios()">Guardar cambios<br>{{this.datos.nombre}}</button>
        </div>
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
                fetch(`http://192.168.210.154:8000/usuarios/cambiar/contrasena/${this.$route.params.id}`, {
                    method: 'POST',
                    body: datosEnvio
                }).then(response => response.json())
                .then(data => this.datos = data);
                console.log(this.datos);
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
    #perfil {
        display: grid;
        grid-template-columns: auto auto;
    }
    #datos {
        margin-right: 5px;
    }
</style>