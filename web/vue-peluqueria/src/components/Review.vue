<template>

  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">{{infoComent.nombre}}</h5>
    <h6 class="card-subtitle mb-2 text-muted">{{infoComent.apellido}}</h6>
    <p class="card-text">{{infoComent.descripcion}}</p>
    <a href="#" class="card-link">{{infoComent.valoracion}}</a>
  </div>
</div>
</template>

<script>
export default{
    props: ['infoComent']
}

</script>
<style>



</style>