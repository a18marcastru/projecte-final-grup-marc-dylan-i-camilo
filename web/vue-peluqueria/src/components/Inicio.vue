<template>
  <div class="hero-image">
    <div class="hero-text">
      <h1 style="font-size:50px">Peluquería Happy</h1>
    </div>
  </div><br>
  <div class="cont-video">
    <video controls="" loop="loop" autoplay="" playsinline="" muted="" src="../../public/video_peluqueria.mp4">
      <source src="/video_peluqueria.mp4" type="video/mp4">
    </video>
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
      fetch("http://192.168.210.154:8000/comentarios/mostrar/comentarios")
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

        fetch('http://192.168.210.154:8000/comentarios/nuevo/comentario', {
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

video {
  width: 60%; 
  margin-left: 20%;
  border: 3px solid black;  
}
</style>
