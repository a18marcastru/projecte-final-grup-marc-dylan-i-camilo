<template>
    <div class="container p-5">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Identifícate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Dirección de correo</label>
                                <input v-model="email" type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input v-model="contrasena" type="password" class="form-control" name="contrasena" id="contrasena" required>
                            </div>
                            <div id="iniSesion">
                              <button @click="login()" id="login" class="btn btn-primary">Iniciar sesión</button><br><br>
                            </div>
                            <p>Al identificarse aceptas nuestras Condiciones de uso y venta. Consulta nuestro Aviso de privacidad y nuestras Aviso de Cookies y Aviso sobre publicidad basada en los intereses del usuario.</p>
                            <hr>
                            <p>No tienes cuenta ? <RouterLink class="btn btn-outline-primary" to="./register">Registrate</RouterLink></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
        console.log(data);
        if(1 == data) {
          let htmlstr = "";
          htmlstr += `<h3>Login realizado correctamente.</h3>`;
          document.getElementById("login").setAttribute("style","display: none;");
          document.getElementById("iniSesion").innerHTML = htmlstr;
        }
      });
    },
  },
}
</script>