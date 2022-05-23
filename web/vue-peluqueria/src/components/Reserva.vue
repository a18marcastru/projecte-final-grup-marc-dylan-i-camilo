<template>
    <Navegador/>
    <h1 id="title-tienda">Reserva un dia en la peluqueria</h1>
    <div id="container-reserva">
      <br>
      <h2>Servicios</h2>
      <div id="servicios">
        <div v-for="ses in servicios">
          <div class="card" id="card-servicios">
            <div class="card-body">
              <p class="card-title">{{ses.nombre_servicio}}</p>
              <p class="card-text">Precio : {{ses.precio}} €</p>
              <button class="btn btn-dark" :id="ses.id" @click="anadir(ses.nombre_servicio, ses.precio, ses.id)">Añadir</button>
              <button class="btn btn-anadido btn-success" :id="ses.id+'c'" @click="anadido(ses.nombre_servicio, ses.precio, ses.id)">Añadido</button>
            </div>
          </div>
        </div>
      </div>
      <p id="precio_total">Precio total: {{this.precio_total}}</p>
      <br>
      <h2>Mes: {{this.mes}}</h2>
      <div id="container-fecha">
        <div id="nombre-dias">
          <div>Lunes</div>
          <div>Martes</div>
          <div>Miercoles</div>
          <div>Jueves</div>
          <div>Viernes</div>
          <div>Sabado</div>
          <div>Domingo</div>
          <div v-for="index in 31">
            <div class="dia btn-dark" :id="index+'p'" @click="fecha(index)">{{index}}</div>
          </div>
        </div>
        <br>
        <h2 id="title-horas">Horas</h2>
        <div id="horas">
          <div id="lista-horas" v-for="index in horas">
            <div class="dia btn-dark" :id="index.hora" @click="selecion_hora(index.hora)">{{index.hora}}</div>
            <br>
          </div>
        </div>
      </div>
    </div>
    <button id="btn-reservar" class="btn btn-dark" @click="reservar()" disabled>Reservar</button>
    <br><br>
</template>

<script>
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  import Navegador from './Navegador.vue';
    export default {
    data() {
        return {
            servicios: [],
            reservas: [],
            total: [],
            horasOcupadas: [],
            horas: [],
            email: "",
            mes: "",
            hora: "",
            dia: 0,
            precio_total: 0
        };
    },
    mounted() {
        fetch(`http://192.168.137.159:8000/servicios/mostrar`)
            .then(res => res.json())
            .then((data) => {
            this.servicios = data;
            console.log(this.servicios);
        });

        fetch(`http://192.168.137.159:8000/reservas/todas`)
            .then(res => res.json())
            .then((data) => {
            this.reservas = data;
            console.log(this.reservas);
        });
        const meses = ["Junio", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const d = new Date();
        this.mes = meses[d.getUTCMonth()];
        const horario = [{ "hora": "10:00" }, { "hora": "11:00" }, { "hora": "12:00" }, { "hora": "13:00" }, { "hora": "14:00" }, { "hora": "15:00" }, { "hora": "16:00" }, { "hora": "17:00" }, { "hora": "18:00" }, { "hora": "19:00" }];
        this.horas = horario;
    },
    computed: {
      ...mapStores(sessioStore)
    },
    methods: {
        anadir(nombre, precio, id) {
            let encontrado = false;
            for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].nombre_servicio == nombre) {
                    encontrado = true;
                }
            }
            if (encontrado == false) {
                this.total.push({ "nombre_servicio": nombre });
                this.precio_total += precio;
                document.getElementById(id + "c").setAttribute("style","display: block");
                document.getElementById(id).setAttribute("style", "display: none;");
                document.getElementById("btn-reservar").removeAttribute("disabled");
            }
            console.log(this.precio_total);
        },
        anadido(nombre, precio, id) {
            for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].nombre_servicio == nombre) {
                    this.total = this.total.filter(obj => obj.nombre_servicio != nombre);
                    document.getElementById(id + "c").setAttribute("style", "display: none;");
                    document.getElementById(id).removeAttribute("style", "display: none;");
                    this.precio_total -= precio;
                    console.log(this.precio_total);
                }
            }
        },
        fecha(index) {
            if(this.dia == 0) {
              this.dia = index;
              let encontrado = false;
              document.getElementById(index + "p").setAttribute("style", "background: green;");
              for(let i = 0;i < this.horasOcupadas.length;i++) {
                if(this.horasOcupadas[i].dia == this.dia) {
                  encontrado = true
                }
              }
              if(encontrado == false) {
                for(let i = 0;i < this.reservas.length;i++) {
                  if(this.reservas[i].dia == index) {
                    this.horasOcupadas.push({"dia": this.dia, "hora": this.reservas[i].hora});
                  }
                }
                for(let i = 0;i < this.horasOcupadas.length;i++) {
                    document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: red;");
                }
              }
              else {
                for(let i = 0;i < this.horasOcupadas.length;i++) {
                    document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: red;");
                }
              }
            }
            else {
              document.getElementById(index + "p").setAttribute("style", "background: dark;");
              let encontrado = false
              for(let i = 0;i < this.horasOcupadas.length;i++) {
                if(this.horasOcupadas[i].dia == this.dia) {
                  encontrado = true;
                }
              }
              if(encontrado == true) {
                for(let i = 0;i < this.horasOcupadas.length;i++) {
                  document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: dark;");
                }
                this.horasOcupadas = this.horasOcupadas.filter(d => d.dia != this.dia);
              }
              this.dia = 0;
            }
        },
        selecion_hora(index) {
          if(this.dia != 0) {
            let num = 0;
            for(let i = 0;i < this.horasOcupadas.length;i++) {
              if(this.hora == "" && index == this.horasOcupadas[i].hora) {
                num = 1;
              }
              else if(this.hora != "" && index != this.horasOcupadas[i].hora){
                num = 2;
              }
            }
            console.log(num)
            if(num == 1) {
              alert("Ya esta reservado");
            }
            else if(num == 2) {
              document.getElementById(index).setAttribute("style", "background: dark;");
              this.hora = "";
            }
            else {
              document.getElementById(index).setAttribute("style", "background: green;");
              this.hora = index;
            }
          }
          else {
            alert("Escoge primero el dia");
          }
        },
        reservar() {
          this.email = this.sessioStore.get.email;
          if(this.email != null) {
            if(this.hora != 0 && this.dia != "") {
              const servicio = JSON.stringify(this.total);
              const datosEnvio = new FormData();
              datosEnvio.append("email", this.email);
              datosEnvio.append("servicios", servicio);
              datosEnvio.append("dia", this.dia);
              datosEnvio.append("hora", this.hora);
              datosEnvio.append("mes", this.mes);
              datosEnvio.append("precio_total", this.precio_total);
              fetch("http://192.168.137.159:8000/reservas/nueva/reserva", {
                  method: "POST",
                  body: datosEnvio
              }).then(function (res) {
                  return res.json();
              }).then(function (data) {
                  console.log(data);
              });
            }
            else {
              alert("Porfavor escoga un dia y hora");
            }
          }
          else {
            alert("Tienes que iniciar sesion para poder reservar");
          }
        },
    },
    components: { Navegador }
}
</script> 

<style>
  h2 {
    margin-left: 20%;
  }
  #title-tienda {
    color: black;
    text-align: center;
  }
  #servicios {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    margin-left: 50px;
  }
  #precio_total {
      margin-left: 50%;
    }
  #container-fecha {
    display: flex;
    margin-right: 30em;
  }
  #nombre-dias {
    display: grid;
    grid-template-columns: repeat(7,1fr);
    column-gap: 20px;
    row-gap: 20px;
    margin-left: 20em;
  }
  .card {
    margin: 5px;
  }
  .btn-anadido {
    display: none;
  }
  .dia {
    padding: 5px;
    font-size: 15px;
    text-align: center;
  }
  #horas {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    column-gap: 20px;
    margin-top: 50px;
  }
  #btn-reservar {
    margin-left: 60em;
  }

  /* Tablet */
  @media screen and (max-width: 992px) and (min-width: 600px) {
    h2 {
      margin-left: 0em;
    }
    #servicios {
      display: grid;
      grid-template-columns: repeat(3,1fr);
    }
    #card-servicios {
      margin: 5px;
      width: 15rem;
      margin-left: -20px;
    }
    #container-fecha {
      display: flow-root;
    }
    #nombre-dias {
      display: grid;
      margin-left: 10em;
    }
    #title-horas {
      margin-left: 13em;
    }
    #horas {
      padding-left: 15em;
      margin-top: 20px;
    }
    #btn-reservar {
      margin-left: 0em;
      margin-left: 45%;
    }
  }

  /* Tablet-horizontal */
  @media screen and (max-width: 1200px) and (min-width: 992px) {
    h2 {
      margin-left: 0em;
    }
    #servicios {
      display: grid;
      grid-template-columns: repeat(4,1fr);
    }
    #card-servicios {
      margin: 5px;
      width: 15rem;
      margin-left: -20px;
    }
    #container-fecha {
      display: flow-root;
    }
    #nombre-dias {
      display: grid;
      margin-left: 17em;
    }
    #title-horas {
      margin-left: 14em;
    }
    #horas {
      margin-left: 23em;
      margin-top: 20px;
    }
    #btn-reservar {
      margin-left: 0em;
      margin-left: 45%;
    }
  }

  /* Mobil */
  @media screen and (max-width: 600px) {
    h2 {
      text-align: center;
    }
    #servicios {
      display: grid;
      grid-template-columns: repeat(2,1fr);
      margin-right: 20px;
    }
    #precio_total {
      margin-left: 40%;
    }
    #card-servicios {
      margin: 5px;
      width: 10rem;
    }
    #container-fecha {
      display: flow-root;
    }
    #nombre-dias {
      display: grid;
      margin-left: 0em;
    }
    #title-horas {
      margin-left: 7em;
    }
    #horas {
      padding-left: 3em;
      margin-top: 20px;
    }
    #btn-reservar {
      margin-left: 0em;
      margin-left: 40%;
    }
  }
</style>