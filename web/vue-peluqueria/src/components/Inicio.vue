<template>
  <Navegador/>
  <div class="hola">
    <h1 class="adios">Peluquería Happy</h1>
  </div>
  
    <br>
  <div class="cont-video">
    <video controls="" loop="loop" autoplay="" playsinline="" muted="" src="/video_peluqueria.mp4">
      <source src="/video_peluqueria.mp4" type="video/mp4">
    </video>
  </div><br>
  <div class="grid-container">
    <div class="grid-item1">
      <h3 class="map-tit text-uppercase">los mejores en la peluquería convencional.</h3><br>
      <p>Situada en el corazón de Pedralbes, La Peluquería Happy abrió sus puertas este 2022. Nuestro equipo lo forman tres profesionales de la cosmética que son a la vez fundadoras de la empresa con una larga experiencia en el mundo de la estética, amantes de la naturaleza y comprometidos con el medio ambiente.</p>
    </div>
    <div class="grid-item2">
    </div>
    <div class="grid-item3">
    </div>  
    <div class="grid-item4">
      <p>Si buscas entre las mejores peluquerías de Barcelona, ¡visítanos! en Happy es mucho más que un centro de peluquería y estética vanguardista, es un rincón de paz donde dejar volar tu imaginación. Nuestro concepto de belleza pasa por mimar cada detalle, desde que el cliente reserva, hasta ver la felicidad en su rostro una vez finaliza el servicio.</p>
      <p>Solo podemos dar las gracias a todas las personas que año tras año pasan por el salón, ellos son los que nos han etiquetado como de las mejores peluquerías de Barcelona.</p>
    </div>
  </div><br>
  <Comentario />
  <Galeria/>
</template>

<script>
import Comentario from "@/components/Comentario.vue";
import Navegador from "@/components/Navegador.vue";
import Galeria from './Galeria.vue';
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
      Comentario,
      Navegador,
      Galeria
    },
    mounted() {
      fetch("http://192.168.210.154:8000/comentarios/mostrar/comentarios")
      .then(res => res.json())
      .then((data) => {
        this.datos = data;
      });
    },
  }
</script>

<style>
.hola{
  width: 100%;
  height: 900px;
  text-align: center;
  padding-top:370px;
}
.adios{

}
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
.hero-text {
  text-align: center;
  position: absolute;
  
  transform: translate(-50%, -50%);
  color: white;
  width: 800px;
  height: 800px;
}
video {
  width: 60%; 
  margin-left: 20%;
  border: 3px solid black;  
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto;
}
.grid-item2, .grid-item3 {
  background-color: white;
  padding: 20px;
  text-align: center;
}
.grid-item1, .grid-item4 {
  background-color: white;
  padding: 10%;
  padding-top: 150px;
}
.grid-item1 {
  border-top: 1px solid rgb(234, 213, 208);
  font-size: 18px;
}
.grid-item2 {
  background-image: url('/imagen1.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  margin: 0px;
  padding: 0%;
}
.grid-item3 {
  background-image: url('/imagen2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  margin: 0px;
  padding: 0%;
}
.grid-item4 {
  border-bottom: 1px solid rgb(234, 213, 208);
  font-size: 18px;
}

</style>
