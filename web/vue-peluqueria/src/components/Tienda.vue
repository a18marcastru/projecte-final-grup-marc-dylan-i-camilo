<template>
  <h1>Tienda de peluqueria</h1>
  <div id="producto">
  <div v-for="ses in datos">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">{{ses.nombre}}</h5>
        <!-- <img :src="infoProduct.imagen"> -->
        <p class="card-subtitle mb-2 text-muted">{{ses.descripcion}}</p>
        <p class="card-text">Stock :  {{ses.cantidad}}</p>
        <p class="card-text">Precio : {{ses.precio}} €</p>
        <button @click="sumar(ses.nombre, ses.cantidad)">+</button>
        <input type="text" :id="ses.nombre" value="0" />
        <button @click="restar(ses.nombre)">-</button>
      </div>
    </div>
  </div>
  </div>
  <button @click="comprar()">Comprar</button>
</template>

<script>
  import Productos from "@/components/Productos.vue";
  export default {
    data() {
      return {
        datos: [],
        total: [],
        email: '',
        precio_total: ''
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
    methods: {
      comprar() {
        console.log("Quiero comprar esto: " + this.seleccion);
      },
      sumar(nombre, stock) {
        console.log(nombre);
        let num = document.getElementById(nombre).value;
        if(num < stock) {
          num++;
          document.getElementById(nombre).value = num;
          let num_total = num;
          let encontrado = false;
          for(let i = 0; i < this.total.length ;i++) {
            //si lo he encontrado, le sumo uno
            if(this.total[i].nombre == nombre) {
              this.total[i].cantidades = num_total;
              encontrado = true;
            }            
          }
          if (encontrado==false){
            this.total.push({'nombre':nombre, 'cantidades': num_total});
          }
          console.log(this.total);
        }
        else {
          alert("No hay suficiente stock");
        }
      },
      restar(nombre) {
        let num = document.getElementById(nombre).value;
        if(num > 0) {
          num--;
          document.getElementById(nombre).value = num;
          let num_total = num;
          let encontrado = "";
          let index = "";
          for(let i = 0; i < this.total.length ;i++) {
            //si lo he encontrado, le sumo uno
            if(this.total[i].nombre == nombre) {
              if(this.total[i].cantidades != 0) {
                this.total[i].cantidades = num_total;
                encontrado = true;
              }
              else {
                console.log("Hola");
                encontrado = false;
                let index = i;
              }
            }            
          }
          if(encontrado == false){
            this.total[index].splice();
          }
          console.log(this.total);
        }
        else if(num == 0) {
          alert("No puedes restar mas");
        }
      },
      comprar() {
        console.log(this.total);
        this.email = "marc@gmail.com";
        this.precio_total = 32;
        const productos = JSON.stringify(this.total);
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('productos', this.productos);
        datosEnvio.append('precio_total', this.precio_total);
        
        fetch('http://192.168.210.154:8000/tickets/nuevo/ticket', {
          method: 'POST',
          body: datosEnvio
        }).then(function(res){
          return res.json();
        }).then(function(data){
          console.log(data)
        });
      }
    }
  }
</script> 

<style>
  h1 {
    text-align: center;
  }
  #producto {
    display: grid;
    grid-template-columns: auto auto;
  }
</style>