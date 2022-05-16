<template>
  <div>
    <h2>Valoracion de usuario</h2>
    <hr>
    <label for="email"><b>Email</b></label>
    <input v-model="email" type="text" placeholder="email" name="email" id="email" required><br><br>
    <label for="valoracion" class="form-label">Valoración:</label>
    <input v-model="valoracion" type="range"  class="multi-range" min="0" max="5" step="0.5" id="valoracion" width="50%"><br><br>
    
    <div class="container">
      <span id="rateMe1"></span>
    </div>

    <label for="descripcion"><b>Comentario</b></label>
    <textarea v-model="descripcion" type="text"  name="descripcion" id="descripcion" style="width:550px; height:200px;" ></textarea><br><br>
    <button @click="comment()">Enviar</button><br><br>

    <div v-for="ses in datos">
          <Review :infoComent="ses"/>
    </div>
  </div>
</template>

<script>
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
#valoracion{
  width: 400px;
}

</style>