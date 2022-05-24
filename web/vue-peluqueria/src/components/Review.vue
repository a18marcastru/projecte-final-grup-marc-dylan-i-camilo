<template>
    <div class="card-body-1">
      <p  class="card-title">{{infoComent.nombre}}</p>
      <p class="card-titles">{{infoComent.apellido}}</p>
      <p class="card-text">{{infoComent.descripcion}}</p>
      <big class="hola" v-for="ses in infoComent.valoracion">
        ⭐
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
  .card-body-1{
    justify-content: center;
    text-align: center;
    width: 480px;
    color: white;
}
.card-title{
  color: white;
}
.card-subtitle{
  color: white;
}

</style>