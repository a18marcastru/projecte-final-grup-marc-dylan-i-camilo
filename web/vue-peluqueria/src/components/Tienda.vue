<template>
  <h1>Tienda de peluqueria</h1>
  <div id="container">
    <div id="container2">
      <div id="productos">
        <div v-for="ses in datos">
          <div class="card" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">{{ses.nombre}}</h5>
              <!-- <img :src="infoProduct.imagen"> -->
              <p class="card-subtitle mb-2 text-muted">{{ses.descripcion}}</p>
              <p class="card-text">Stock :  {{ses.cantidad}}</p>
              <p class="card-text">Precio : {{ses.precio}} €</p>
              <button class="btn btn-primary" @click="sumar(ses.nombre, ses.cantidad, ses.precio)">+</button>
              <input type="text" :id="ses.nombre" value="0" />
              <button class="btn btn-primary" @click="restar(ses.nombre, ses.precio)">-</button>
            </div>
          </div>
        </div>
      </div>
      <div id="caruaje">
        <h2>Lista de productos:</h2>
        <div id="lista"></div>
        <button class="btn btn-primary" id="btn-comprar" @click="comprar()" disabled>Comprar</button>
      </div>
    </div>
    <br>
    <div id="conf" hidden>
      <input v-model="email" type="text" placeholder="Email" name="email" id="email" required />
      <button class="btn btn-primary" @click="confirmar()">Confirmar</button>
    </div>
  </div>
</template>

<script>
  import Productos from "@/components/Productos.vue";
  export default {
    data() {
      return {
        datos: [],
        total: [],
        email: '',
        precio_total: 0,
        stocks_total: 0,
        stock_groups: {}
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
      sumar(nombre, stock, precio) {
        console.log(nombre);
        let num = document.getElementById(nombre).value;
        if(num < stock) {
          num++;
          document.getElementById(nombre).value = num;
          let num_total = num;
          let encontrado = false;
          for (let i = 0; i < this.total.length ;i++) {
            //si lo he encontrado, le sumo uno
            if (this.total[i].nombre == nombre) {
              this.total[i].cantidades = num_total;
              encontrado = true;
            }            
          }
          if (encontrado == false){
            this.total.push({'nombre':nombre, 'cantidades': num_total});
          }
          console.log(this.total);
          this.actualizar(nombre, num_total, precio);
        }
        else {
          alert("No hay suficiente stock");
        }
      },
      actualizar(nombre, num_total, precio){
        let htmlstr = "";
        for(let i = 0;i < this.total.length;i++) {
          if(this.total[i].cantidades != 0) {
            htmlstr += `<h3>Aticulo: ${i+1}</h3><p class>Nombre del producto: ${this.total[i].nombre}</p>
                        <p>Unidades: ${this.total[i].cantidades}`;
          }
        }
        this.stock_groups[nombre] = precio * num_total;
        console.log(this.stock_groups);
        this.precio_total = Object.values(this.stock_groups).reduce((acc,curr) => acc + curr,0);
        htmlstr += "<hr/>";
        htmlstr += `<p>Precio total: ${this.precio_total}</p>`;
        document.getElementById("lista").innerHTML = htmlstr;
        document.getElementById("btn-comprar").removeAttribute("disabled");
      },
      restar(nombre, precio) {
        let num = document.getElementById(nombre).value;
        if(num > 0) {
          num--;
          document.getElementById(nombre).value = num;
          let num_total = num;
          let index = "";
          for(let i = 0; i < this.total.length ;i++) {
            //si lo he encontrado, le resto uno
            if(this.total[i].nombre == nombre) {
              if(num_total != 0) {
                this.total[i].cantidades = num_total;
              }
              else {
                this.total[i].cantidades = num_total;
                this.total = this.total.filter(can => can.cantidades > 0);
              }
            }            
          }
          console.log(this.total);
          this.actualizar(nombre, num_total, precio)
        }
        else if(num == 0) {
          alert("No puedes restar mas");
        }
      },
      confirmar() {
        console.log(this.email);
        const productos = JSON.stringify(this.total);
        const datosEnvio = new FormData();
        datosEnvio.append('email', this.email);
        datosEnvio.append('productos', productos);
        datosEnvio.append('precio_total', this.precio_total);
        
        fetch('http://192.168.210.154:8000/tickets/nuevo/ticket', {
          method: 'POST',
          body: datosEnvio
        }).then(function(res){
          return res.json();
        }).then(function(data){
          console.log(data)
        });
      },
      comprar() {
        document.getElementById("conf").removeAttribute("hidden");
      }
    }
  }
</script> 

<style>
  h1 {
    text-align: center;
  }
  #container2 {
    display: flex;
  }
  #productos {
    display: grid;
    grid-template-columns: auto auto;
  }
  #caruaje {
    margin-left: 30%;
    padding: 5px;
  }
</style>