<template>
        <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{infoProduct.nombre}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{infoProduct.descripcion}}</h6>
            <p class="card-text">{{infoProduct.cantidad}}</p>
            <p class="card-text">{{infoProduct.precio}}</p>
        </div>
        </div>
</template>

<script>
export default {
    props: ['infoProduct'],
}
</script>