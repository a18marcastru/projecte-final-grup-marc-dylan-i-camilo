<template>
  <div>
    <h2 style="color: white;">Valoración de usuarios</h2>
    <hr>
    <div id="container">
      <div v-for="ses in datos">
        <Review :infoComent="ses"/>
      </div>
    </div>
    <h2 style="color: white;">Envianos tu valoración</h2>
    <hr>
    <label for="valoracion" class="form-label" style="color: white;"><b>Valoración:</b></label><br>
    <input v-model="valoracion" type="range"  class="multi-range" min="0" max="5" step="0.5" id="valoracion" width="50%"><br><br>
    <div class="container">
      <span id="rateMe1"></span>
    </div>
    <label for="descripcion" style="color: white;"><b>Comentario</b></label>
    <br>
    <textarea v-model="descripcion" type="text"  name="descripcion" id="descripcion" style="width:350px; height:100px;" ></textarea><br><br>
    <button class="btn btn-success" @click="comment()">Enviar</button><br><br>

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
  }
</style>