<script>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
export default {
        data() {
            return {
                email: '',
                contrasena: '',
            }
        },
        methods: {
            login() {
                console.log(this.email+ " " +  this.contrasena + " " );
                const datosEnvio = new FormData();
                datosEnvio.append('email', this.email);
                datosEnvio.append('contrasena', this.contrasena);


                fetch('http://192.168.210.153:8000/usuarios/login', {
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


<template>
  <header>
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Login
        </button>
      </nav>
  </header>
  <div class="container p-5">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Login Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="email" class="form-label">Dirección de correo</label>
                <input v-model="email" type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
              </div>
              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input v-model="contrasena" type="password" class="form-control" name="contrasena" id="contrasena" required>
              </div>
              <button type="submit" @click="login()" class="btn btn-primary">Login</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
