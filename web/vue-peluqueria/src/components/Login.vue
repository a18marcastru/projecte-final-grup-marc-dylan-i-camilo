<template>
  <Navegador/>
  <br>
  <div id="container-login">
    <div id="login">
      <h1>Iniciar sesion</h1>
      <input v-model="email" type="text" id="email" name="email" placeholder="email" required><br><br>
      <input v-model="contrasena" type="password" id="pwd" name="contrasena" placeholder="contraseña" required><br><br>
      <div id="loginBtn">
        <button class="btn btn-dark" type="submit" @click="login()">Login</button><br>
      </div>
      <p id="mensaje" hidden>*No existe usuario con este {{this.email}}</p>
    </div>
    <div id="iniciado" hidden>
      <h1>Bienvenido de nuevo {{this.email}}</h1>
      <RouterLink to="/" id="inicio" class="btn btn-dark">Volver a la pagina de inicio</RouterLink>
    </div>
  </div>
  <br>
</template>

<script>
  import Navegador from './Navegador.vue';
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  export default {
    data() {
        return {
            email: "",
            contrasena: "",
            datos: "",
            logueado: false,
            id_user: 0
        };
    },
    computed: {
      ...mapStores(sessioStore)
    },
    methods: {
        login() {
            const datosEnvio = new FormData();
            datosEnvio.append("email", this.email);
            datosEnvio.append("contrasena", this.contrasena);
            fetch("http://localhost:8000/usuarios/login", {
                method: "POST",
                body: datosEnvio
            }).then(response => response.json())
              .then(data => this.datos = data);
            if (this.datos != "Contraseña incorrecta" && this.datos != "No existe usuario" && this.datos != "") {
              document.getElementById("iniciado").removeAttribute("hidden");
              document.getElementById("login").setAttribute("style","display: none;");
              this.logueado = true;
              this.id = this.datos;
              this.sessioStore.set({id_user: this.id, estado: this.logueado, email: this.email });
            }
            else if(this.datos == "Contraseña incorrecta" && this.datos != "No existe usuario" && this.datos != "") {
              document.getElementById("pwd").setAttribute("style","background-color: red;");
            }
            else if( this.datos != "Contraseña incorrecta" && this.datos == "No existe usuario" && this.datos != "") {
              document.getElementById("email").setAttribute("style","background-color: red;");
              document.querySelector("p").removeAttribute("hidden");
            }
        },
    },
    components: { Navegador }
}
</script>

<style>
  h1 {
    color: white;
  }
  #container-login {
    display: flex;
    justify-content: center;
  }
  #login {
    border: 1px solid black;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    background-color: black;
  }
  #email {
    margin-left: 50px;
  }
  #pwd {
    margin-left: 50px;
  }
  #mensaje {
    color: white;
  }
  #iniciado {
    border: 1px solid black;
    border-radius: 5px;
    padding: 20px;
    background-color: black;
  }
  #email, #pwd {
    margin-right: 50px;
  }
  #loginBtn {
    text-align: center;
  }
</style>