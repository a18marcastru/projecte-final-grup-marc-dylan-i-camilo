<template>
  <div>
    <h2 class="titulo">Valoración de usuarios</h2>
    <hr>
    <div id="container">
      <div class="caja" v-for="ses in datos">
        <Review :infoComent="ses"/>
      </div>
    </div>

   
    <div class="card" style="width: 50rem;">
  <div class="card-body">
    <h5 class="card-title">Valoracion de los usuarios</h5>
    <p class="card-text">Deja aqui tu rango de valoracion + comentario sobre nuestro servicio.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> <blockquote class="blockquote">
  </blockquote>
  <figcaption class="blockquote-footer">
   Gracias por tus comentario! Estamos trabajando arduamente para mejorar el servicio en funcion de nuestras propias pruebas y de tus comentarios.
      Si ya enviaste tus comentario , no es necesario que hagas nada mas.Hacemos un seguimiento y revisamos todas las solicitudes.
      Si notaste algún problemas con nuestro servicio , nuestro equipo hará todo lo posible para corregirlo.Vuelve en unos dias. <cite title="Source Title">Equipo Happy</cite>
  </figcaption></li>
      <li class="list-group-item">
         <label for="valoracion" class="form-label" style="color: white;"><b>Valoración:</b></label><br>
    <input v-model="valoracion" type="range"  class="multi-range" min="0" max="5" step="0.5" id="valoracion" width="50%"><br><br>
    <div class="container">
      <span id="rateMe1"></span>
    </div>
      </li>

    <li class="list-group-item">
        <label for="descripcion"><b>Comentario</b></label>
    <br>
    <textarea v-model="descripcion" type="text"  name="descripcion" id="descripcion" style="width:350px; height:100px;" ></textarea><br><br>
    </li>
  </ul>
  <div class="card-body">
    <button  class="btn btn-success" @click="comment()">Enviar</button><br><br>
  </div>
</div>
<br><br>
<br><br>
<br><br>










  </div>
</template>

<script>
import { sessioStore } from '@/stores/sessioStore'
import { mapStores } from 'pinia'
    import Review from "@/components/Review.vue";
    export default {
        data() {
          return {
              email: '',
              valoracion: '',
              descripcion: '',
              datos: [],
          }
        },
        computed: {
          ...mapStores(sessioStore)
        },
        components: {
            Review
        },
        mounted() {
        fetch("http://192.168.210.154:8000/comentarios/mostrar/comentarios")
        .then(res => res.json())
        .then((data) => {
          this.datos = data;
          console.log(this.datos);
        });
        },
        methods: {
          comment() {
            this.email = this.sessioStore.get.email;
            if(this.email != null) {
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
            }
            else {
              alert("Tienes que iniciar sesion para poder valorar");
            }
          },
        },
    }
</script> 

<style>
  #valoracion{
    width: 400px;
  }
  #container {
    display: flex;
    margin: auto;
    width: 50%;
    border: 5px;
    padding: 10px;
  }
  .caja{
  }
 .card-body{
    justify-content: center;
    text-align: center;
    background-color: #3C3C3C;

 }
 .card{
   justify-content: center;
   margin-left: 30%;
       background-color: #3C3C3C;

 }
 .list-group-item{
   justify-content: center;
   text-align: center;
   background-color: #3C3C3C;

 }
 .card-title{
   color: white;
 }
 .card-text{
   color: white;
 }
 .titulo{
   justify-content: center;
   text-align: center;
   color: white;
 }
</style>