<template>
         <div v-for="ses in datos">
          <Productos :infoProduct="ses"/>   
         </div>     

    
</template>

<script>
  import Productos from "@/components/Productos.vue";
  export default {
    data() {
      return {
        nombre: '',
        descripcion: '',
        cantidad: '',
        precio:'',

      }
    },
    components: {
        Productos
    },
    mounted() {
      fetch("http://192.168.210.154:8000/productos/catalogo")
      .then(res => res.json())
      .then((data) => {
        this.datos = data;
        console.log(this.datos);
      });
    },
    }


</script> 
