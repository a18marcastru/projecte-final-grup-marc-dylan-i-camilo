<template>
  <div class="hero-image">
    <div class="hero-text">
      <h1 style="font-size:50px">Peluquería Happy</h1>
    </div>
  </div>
  <Comentario />
</template>

<script>
import Comentario from "@/components/Comentario.vue";
export default {
    data() {
      return {
        email: '',
        valoracion: '',
        descripcion: '',
        datos: [],

      }
    },
    components: {
      Comentario
    },
    mounted() {
      fetch("http://localhost:8000/comentarios/mostrar/comentarios")
      .then(res => res.json())
      .then((data) => {
        this.datos = data;
      });
    },
    methods: {
      comment() {
        console.log(this.email + " " + this.valoracion + " " +  this.descripcion + " " );
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('valoracion', this.valoracion);
        datosEnvio.append('descripcion', this.descripcion);

        fetch('http://localhost:8000/comentarios/nuevo/comentario', {
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

<style>
body {
  margin: 0;
  padding: 0%;
  font-family: Arial, Helvetica, sans-serif;
}
.navbar navbar-light{
  margin: 0%;
  padding: 0%;
  background-color: aliceblue;

}
.hero-image {
  background-image: url("./salon.jpg");
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin: 0px;
  padding: 0%;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}
</style>
