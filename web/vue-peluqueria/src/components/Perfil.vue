<template>
    <Navegador/>
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
    <h2>Datos de reservas y compras</h2>
    <div id="datos2">
        <div id="reservas">
            <h2>Reservas</h2>
            <div v-for="ses in reservas">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <p class="card-title">- Servicio: {{ses.nombre_servicio}}</p>
                        <p class="card-subtitle">- Hora: {{ses.hora}} <br> - Dia: {{ses.dia}} <br> - Mes: {{ses.mes}}</p>
                        <p class="card-text">- Precio total: {{ses.precio_total}} €</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h2>Compras</h2>
            <div v-for="ses in tickets">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <p class="card-title">- Articulo: {{ses.nombre}}</p>
                        <p class="card-subtitle">- Fecha: {{ses.fecha}}</p>
                        <p class="card-text">- Precio total: {{ses.precio_total}} €</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { sessioStore } from '@/stores/sessioStore';
    import { mapStores } from 'pinia';
    import Navegador from './Navegador.vue';
    export default {
    data() {
        return {
            datos: [],
            reservas: [],
            tickets: [],
            nombre: "",
            apellido: "",
            telefono: "",
            email: "",
            id_user: '',
            contrasena:''
        };
    },
    computed: {
            ...mapStores(sessioStore)
    },
    mounted() {
        console.log(this.$route.params.id)
        this.id_user = this.sessioStore.get.id_user;
        if(this.id_user == this.$route.params.id) {
            fetch(`http://localhost:8000/usuarios/perfil/${this.$route.params.id}`)
                .then(res => res.json())
                .then((data) => {
                this.datos = data;
                for(let i = 0;i < this.datos.reservas.length;i++) {
                    this.reservas = this.datos.reservas;
                }
                for(let i = 0;i < this.datos.tickets.length;i++) {
                    this.tickets = this.datos.tickets;
                }
            });
        }
        else {
            alert("Tienes que iniciar sesion");
        }
    },
    methods: {
        cambios() {
            if(this.id_user == this.$route.params.id) {
            const datosEnvio = new FormData();
            datosEnvio.append("contrasena", this.contrasena);
            fetch(`http://localhost:8000/usuarios/cambiar/contrasena/${this.$route.params.id}`, {
                method: "PUT",
                body: datosEnvio
            }).then(response => response.json())
                .then(data => this.datos = data);
            }
            else {
                alert("No puedes cambiar la contraseña, porque no has iniciado sesion");
            }
        },
    },
    components: { Navegador }
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
    #datos2 {
        display: flex;
    }
    #reservas {
        margin-right: 50%;
    }
</style>