<template>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{infoProduct.nombre}}</h5>
            <!-- <img :src="infoProduct.imagen"> -->
            <p class="card-subtitle mb-2 text-muted">{{infoProduct.descripcion}}</p>
            <p class="card-text">Stock :  {{infoProduct.cantidad}}</p>
            <p class="card-text">Precio : {{infoProduct.precio}} €</p>
            <button @click="sumar(infoProduct.nombre)">+</button>
            <input type="text" :id="infoProduct.nombre" value="0" />
            <button @click="restar(infoProduct.nombre)">-</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
      return {
      }
    },
    props: ['infoProduct'],
}
</script>