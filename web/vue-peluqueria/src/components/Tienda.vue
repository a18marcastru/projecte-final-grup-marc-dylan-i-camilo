<template>
  <div>
    <Productos v-for="ses in datos" :infoProduct="ses">
    </Productos>   
  </div>      
</template>

<script>
  import Productos from "@/components/Productos.vue";
  export default {
    data() {
      return {
        datos: [],
      }
    },
    components: {
        Productos
    },
    mounted() {
      fetch(`http://192.168.210.154:8000/productos/catalogo`)
      .then(res => res.json())
      .then((data) => {
        this.datos = data;
        console.log(this.datos);
      });
    },
  }
</script> 
