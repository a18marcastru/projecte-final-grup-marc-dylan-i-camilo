<template>
    <div class="card-body">
      <h5 class="card-title">{{infoComent.nombre}}</h5>
      <h6 class="card-subtitle mb-2 text-muted">{{infoComent.apellido}}</h6>
      <p class="card-text">{{infoComent.descripcion}}</p>
      valoración: 
      <big class="hola" v-for="ses in infoComent.valoracion">
        ★
      </big>
    </div>
</template>

<script>
export default{
    props: ['infoComent']
}

</script>
<style>
  .grid-stars {
    width: 5px;
    margin: 0px;
    padding: 0px;
  }
  .hola{
    margin : 0px;
    padding : 0px;
  }
</style>