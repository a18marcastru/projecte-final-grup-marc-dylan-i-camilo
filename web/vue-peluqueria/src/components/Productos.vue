<template>
    <div class="card grid-container" style="width: 18rem;">
        <div class="card-body item">
            <h5 class="card-title">{{infoProduct.nombre}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{infoProduct.descripcion}}</h6>
            <p class="card-text">Cantidad :  {{infoProduct.cantidad}}</p>
            <p class="card-text">Precio : {{infoProduct.precio}} €  </p>
            <button class="agregar">+</button><input type="text" value="0"><button class="quitar">-</button>
        </div>
    </div>
    <div class="card-body item">
        
    </div>
</template>

<script>
export default {
    props: ['infoProduct'],
}
</script>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
    }
    .item {

    }
</style>