<template>
  <Navegador/>
  <h1 id="title-tienda">Tienda de peluqueria</h1>
  <div id="container-tienda">
    <div id="productos">
      <div v-for="ses in datos">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ses.nombre}}</h5>
            <img :src="ses.imagen" alt="Producto">
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
    <div id="barra"></div>
    <div id="lista">
      <h2>Lista de productos:</h2>
      <div id="lista-producto"></div>
      <hr>
      <p id="precio_total">Precio total: {{this.precio_total}}</p>
      <button class="btn btn-primary" id="btn-comprar" @click="comprar()" disabled>Comprar</button>
    </div>
  </div>
  <br><br>
</template>

<script>
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  import Navegador from './Navegador.vue';
  export default {
    data() {
        return {
            datos: [],
            total: [],
            email: "",
            precio_total: 0,
            stocks_total: 0,
            stock_groups: {}
        };
    },
    computed: {
      ...mapStores(sessioStore)
    },
    mounted() {
        fetch(`http://192.168.137.159:8000/productos/catalogo`)
            .then(res => res.json())
            .then((data) => {
            this.datos = data;
        });
    },
    methods: {
        sumar(nombre, stock, precio) {
            let unidades = document.getElementById(nombre).value;
            if (unidades < stock) {
              unidades++;
              document.getElementById(nombre).value = unidades;
              let num_total = unidades;
              let encontrado = false;
              for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].nombre == nombre) {
                  this.total[i].cantidades = num_total;
                  encontrado = true;
                }
              }
              if (encontrado == false) {
                  this.total.push({ "nombre": nombre, "cantidades": num_total });
              }
              this.actualizar(nombre, num_total, precio);
            }
            else {
              alert("No hay suficiente stock");
            }
        },
        actualizar(nombre, num_total, precio) {
            let htmlstr = "";
            for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].cantidades != 0) {
                  htmlstr +=`<div id="articulo">
                              <h4>Aticulo: ${i + 1}</h4>
                              <p class>- Nombre del producto: ${this.total[i].nombre}</p>
                              <p>- Unidades: ${this.total[i].cantidades}
                            </div>`;
                }
            }
            this.stock_groups[nombre] = precio * num_total;
            this.precio_total = Object.values(this.stock_groups).reduce((acc, curr) => acc + curr, 0);
            document.getElementById("lista-producto").innerHTML = htmlstr;
            document.getElementById("btn-comprar").removeAttribute("disabled");
        },
        restar(nombre, precio) {
            let num = document.getElementById(nombre).value;
            if (num > 0) {
                num--;
                document.getElementById(nombre).value = num;
                let num_total = num;
                for (let i = 0; i < this.total.length; i++) {
                  if (this.total[i].nombre == nombre) {
                    if (num_total != 0) {
                      this.total[i].cantidades = num_total;
                    }
                    else {
                      this.total[i].cantidades = num_total;
                      this.total = this.total.filter(can => can.cantidades > 0);
                    }
                  }
                }
              this.actualizar(nombre, num_total, precio);
            }
            else if (num == 0) {
              alert("No puedes restar mas");
            }
        },
        comprar() {
            this.email = this.sessioStore.get.email;
            if(this.email != null) {
              console.log(this.email);
              const productos = JSON.stringify(this.total);
              const datosEnvio = new FormData();
              datosEnvio.append("email", this.email);
              datosEnvio.append("productos", productos);
              datosEnvio.append("precio_total", this.precio_total);
              fetch("http://192.168.137.159:8000/tickets/nuevo/ticket", {
                  method: "POST",
                  body: datosEnvio
              }).then(function (res) {
                  return res.json();
              }).then(function (data) {
                  console.log(data);
              });
            }
            else {
              alert("Tienes que iniciar sesion para poder comprar");
            }
        }
    },
    components: { Navegador }
}
</script> 

<style>
  #title-tienda {
    color: black;
    text-align: center;
  }
  #container-tienda {
    display: flex;
  }
  #barra {
    background-color: black;
    border: 5px solid black;
    margin-right: 5px;
  }
  #productos {
    display: grid;
    grid-template-columns: repeat(4,1fr);
  }
  #lista-producto {
      margin-left: 30px;
  }
  .card {
    margin: 5px;
    width: 20rem;
  }

/* Tablet */
  @media screen and (max-width: 992px) {
    #container-tienda {
      display: flow-root;
    }
    #productos {
      display: grid;
      grid-template-columns: repeat(2,1fr);
    }
    #lista-producto {
      display: grid;
      grid-template-columns: repeat(2,1fr);
    }
    #articulo {
      margin-left: 20%;
    }
    #precio_total {
      margin-left: 40%;
    }
    .card {
      margin-left: 50px;
    }
    #lista-producto {
      margin-left: 10px;
    }
    h2 {
      text-align: center;
    }
    #btn-comprar {
      margin-left: 21rem;
    }
  }

    /* Tablet-hroizontal */
  @media screen and (max-width: 1200px) and (min-width: 992px) {
    #container-tienda {
      display: flow-root;
    }
    #productos {
      display: grid;
      grid-template-columns: repeat(3,30%);
    }
    #lista-producto {
      display: grid;
      grid-template-columns: repeat(3,30%);
    }
    #articulo {
      margin-left: 20%;
    }
    #precio_total {
      margin-left: 45%;
    }
    .card {
      margin-left: 50px;
    }
    #lista-producto {
      margin-left: 10px;
    }
    h2 {
      text-align: center;
    }
    #btn-comprar {
      margin-left: 31rem;
    }
  }

  /* Mobil */
  @media screen and (max-width: 600px){
    #container-tienda {
      display: flow-root;
    }
    #productos {
      display: grid;
      grid-template-columns: repeat(1,1fr);
    }
    .card {
      margin-left: 50px;
    }
    #lista-producto {
      margin-left: 10px;
    }
    h2 {
      text-align: center;
    }
    #btn-comprar {
      margin-left: 10rem;
    }
  }

</style>