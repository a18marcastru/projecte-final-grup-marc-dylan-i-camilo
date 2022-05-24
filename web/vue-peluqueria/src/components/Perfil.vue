<template>
    <Navegador/>
    <div class="grid-container"> 
        <div class="user-item1" id="datos" style="color: white;">
            <h1>Perfil del usuario</h1><br>
            <table>
                <tbody>
                    <tr>
                        <th>Nombre:</th>
                        <td>
                            <span>{{this.datos.nombre}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Apellido:</th>
                        <td>
                            <span>{{this.datos.apellido}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>telefono:</th>
                        <td>
                            <span>{{this.datos.telefono}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>
                            <span>{{this.datos.email}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="user-item2">
            <h2 style="color: white;">Cambiar contraseña:</h2>
            <input v-model="contrasena" type="password" id="pwd2" name="contrasena2" size="30" placeholder="introduce nueva contraseña" required><br><br>
            <button class="btn btn-success" type="submit" id="perfilBtn" @click="cambios()">Guardar cambios<br>{{this.datos.nombre}}</button>
        </div>
        <div class="user-item3">
            <h2 style="color: white;">Historial de reservas y compras</h2>
            <br>
            <div id="reservas">
                <h2 style="color: white;">Reservas</h2>
                <div v-for="ses in reservas">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <p class="card-title">- Servicio: {{ses.nombre_servicio}}</p>
                            <p class="card-subtitle">- Hora: {{ses.hora}} <br> - Dia: {{ses.dia}} <br> - Mes: {{ses.mes}}</p>
                            <p class="card-text">- Precio total: {{ses.precio_total}} €</p>
                        </div>
                    <button class="btn btn-danger" @click="cancelar(ses.servicio_id)">Cancelar reserva</button>
                    <h3 id="contra" hidden>Contraseña cambiada con exito</h3>
                    </div>
                    <br>  
                </div>
            </div>
        </div>
        <div class="user-item4">
            <br><br>
            <h2 style="color: white;">Compras</h2>
            <div v-for="ses in tickets">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <p class="card-title">- Articulo: {{ses.nombre}}</p>
                        <p class="card-subtitle">- Fecha: {{ses.fecha}}</p>
                        <p class="card-text">- Precio total: {{ses.precio_total}} €</p>
                    </div>
                </div><br>
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
            fetch(`http://192.168.210.154:8000/usuarios/perfil/${this.$route.params.id}`)
            .then(res => res.json())
            .then((data) => {
                this.datos = data;
                console.log(this.datos)
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
                fetch(`http://192.168.210.154:8000/usuarios/cambiar/contrasena/${this.$route.params.id}`, {
                    method: "POST",
                    body: datosEnvio
                }).then(response => response.json())
                .then(data => this.datos = data);
            }
            else {
                alert("No puedes cambiar la contraseña, porque no has iniciado sesion");
            }
        },
        cancelar(id) {
            console.log(id);
            fetch(`http://192.168.210.154:8000/reservas/cancelar/reserva/${id}`, {
                method: "DELETE"
            }).then(response => response.json());
        }
    },
    components: { Navegador }
}            
</script>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto;
    }
    table {
        margin-left: 20rem;
    }
    .user-item1, .user-item2, .user-item3, .user-item4 {
        padding: 50px;
        font-size: 20px;
        text-align: center;
    }
    #contra {
        color: green;
    }
    span {
        margin-left: 20px;
    }
    @media screen and (max-width: 600px) {
        .grid-container {
            display: grid;
            grid-template-columns: auto;
        }
        .user-item1, .user-item2, .user-item3, .user-item4 {
            padding: 0px;
            font-size: 20px;
        }
        span {
            margin-left: 20px;
        }
    }   
</style>