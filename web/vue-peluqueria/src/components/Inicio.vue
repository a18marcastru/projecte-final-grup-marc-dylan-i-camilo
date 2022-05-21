<template>
  <Navegador/>
  <div class="hero-image">
    <div class="hero-text">
      <h1 style="font-size:50px">Peluquería Happy</h1>
    </div>
  </div><br>
  <div class="cont-video">
    <video controls="" loop="loop" autoplay="" playsinline="" muted="" src="../../public/video_peluqueria.mp4">
      <source src="/video_peluqueria.mp4" type="video/mp4">
    </video>
  </div><br>
  <div class="grid-container">
    <div class="grid-item1">
      <p>Una alternativa a la peluquería convencional.</p><br>
      <p>Situada en el corazón de Pedralbes, La Peluquería Happy abrió sus puertas este 2022. Nuestro equipo lo forman dos profesionales de la cosmética natural que son a la vez fundadoras de la empresa con una larga experiencia en el mundo de la Bio peluquería, amantes de la naturaleza y comprometidas con el medio ambiente.</p>
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
</template>

<script>
import Comentario from "@/components/Comentario.vue";
import Navegador from "@/components/Navegador.vue";
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
    Navegador
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
}

</style>
