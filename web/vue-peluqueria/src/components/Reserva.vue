<template>
    <Navegador/>
    <h1 id="title-reserva">Reserva un dia en la peluqueria</h1>
    <div id="container-reserva">
      <br>
      <h2>Servicios</h2>
      <div id="servicios">
        <div v-for="ses in servicios">
          <div class="card" id="card-servicios">
            <div class="card-body">
              <h4 class="card-title" style="color:white">{{ses.nombre_servicio}}</h4>
              <p class="card-text" style="color:white">Precio : {{ses.precio}} €</p>
              <button class="btn btn-dark" :id="ses.id" @click="anadir(ses.nombre_servicio, ses.precio, ses.id)">Añadir</button>
              <button class="btn btn-descartar btn-success" :id="ses.id+'c'" @click="descartar(ses.nombre_servicio, ses.precio, ses.id)">Descartar</button>
            </div>
          </div>
        </div>
      </div>
      <p id="precio_total">Precio total: {{this.precio_total}}€</p>
      <br>
      <h2>Mes: {{this.mes}}</h2>
      <div id="container-fecha">
        <div id="nombre-dias">
          <div class="n-dia">Lunes</div>
          <div class="n-dia">Martes</div>
          <div class="n-dia">Miercoles</div>
          <div class="n-dia">Jueves</div>
          <div class="n-dia">Viernes</div>
          <div class="n-dia">Sabado</div>
          <div class="n-dia">Domingo</div>
          <div v-for="index in 31">
            <button class="btn btn-warning" :id="index+'p'" @click="fecha(index)">{{index}}</button>
          </div>
        </div>
        <br>
        <h2 id="title-horas">Horas</h2>
        <div id="horas">
          <div id="lista-horas" v-for="index in horas">
            <button class="btn btn-outline-warning" :id="index.hora" @click="selecion_hora(index.hora)">{{index.hora}}</button>
            <br><br>
          </div>
        </div>
      </div>
    </div>
    <br>
    <button id="btn-reservar" class="btn btn-success" @click="reservar()" disabled>Reservar</button>
    <br><br>
</template>

<script>
  import Swal from 'sweetalert2';
  import { sessioStore } from '@/stores/sessioStore';
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
        fetch(`http://peluqueriahappyback.alumnes.inspedralbes.cat/servicios/catalogo`)
            .then(res => res.json())
            .then((data) => {
            this.servicios = data;
        });

        fetch(`http://peluqueriahappyback.alumnes.inspedralbes.cat/reservas/reservas_selecionadas`)
            .then(res => res.json())
            .then((data) => {
            this.reservas = data;
            for(let i = 0;i < this.reservas.length;i++) {
              this.horasOcupadas.push({"dia": this.reservas[i].dia, "hora": this.reservas[i].hora});
            }
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
        //En esta parte es comprobar si el servicio ya fue seleccionado, sino se añadira a una array que se utilizara para enviarlo a la base de datos.
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
      },
      descartar(nombre, precio, id) {
        //En esta parte es comprobar si, ya hay un servicio, se quitara de la array.
        for (let i = 0; i < this.total.length; i++) {
          if (this.total[i].nombre_servicio == nombre) {
            this.total = this.total.filter(obj => obj.nombre_servicio != nombre);
            document.getElementById(id + "c").setAttribute("style", "display: none;");
            document.getElementById(id).removeAttribute("style", "display: none;");
            this.precio_total -= precio;
          }
        }
      },
      fecha(index) {
        //En esta funcion se encarga de comprobar si el dia esta seleccionado, el dia esta en el array de horasOcupadas o no y pintarlo.
        if(this.dia == 0) {
          this.dia = index;
          let encontrado = false;
          document.getElementById(index + "p").setAttribute("style", "background: green;");
          for(let i = 0;i < this.horasOcupadas.length;i++) {
            if(this.horasOcupadas[i].dia == this.dia) {
              encontrado = true
            }
          }
          //En esta aperte es para saber si el dia tiene horas ocupadas se mostraran en rojo o no en negro.
          if(encontrado == true) {
            for(let i = 0;i < this.horasOcupadas.length;i++) {
              if(this.horasOcupadas[i].dia == this.dia) {
                document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: red;");
              }
            }
          }
          else {
            for(let i = 0;i < this.horasOcupadas.length;i++) {
              document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: dark;");
            }
          }
        }
        else if(this.dia != index){
          document.getElementById(this.dia + "p").setAttribute("style", "background: dark;");
          document.getElementById(index + "p").setAttribute("style", "background: green;");
          for(let i = 0;i < this.horasOcupadas.length;i++) {
            if(this.dia == this.horasOcupadas[i].dia) {
              document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: dark;");
            }
          }
          this.dia = index;
          for(let i = 0;i < this.horasOcupadas.length;i++) {
            if(index == this.horasOcupadas[i].dia) {
              document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: red;");
            }
          }
        }
        else if(this.dia == index) {
          document.getElementById(index + "p").setAttribute("style", "background: dark;");
          for(let i = 0;i < this.horasOcupadas.length;i++) {
            if(index == this.horasOcupadas[i].dia) {
              document.getElementById(this.horasOcupadas[i].hora).setAttribute("style","background-color: dark;");
            }
          }
          this.dia = 0;
        }
      },
      selecion_hora(index) {
        //La primera condicion es en que si el usuario escoge primero una la hora y no el dia saldra un mensaje de alert.
        if(this.dia != 0) {
          if(this.hora == index || this.hora == "") {
            let num = 0;
            for(let i = 0;i < this.horasOcupadas.length;i++) {
              if(this.dia == this.horasOcupadas[i].dia && this.hora == "" && index == this.horasOcupadas[i].hora || this.dia == this.horasOcupadas[i].dia && this.hora != "" && index == this.horasOcupadas[i].hora) {
                num = 1;
              }
              else if(this.hora != "" && index != this.horasOcupadas[i].hora || this.hora != "" && index == this.horasOcupadas[i].hora || this.dia != this.horasOcupadas[i].dia && this.hora != "" && index != this.horasOcupadas[i].hora){
                num = 2;
              }
            }
            console.log(num)
            if(num == 1) {
              Swal.fire({
                icon: 'error',
                title: 'Reserva ocupada',
                text: 'Ya esta reservado',
              });
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
            Swal.fire({
              icon: 'warning',
              title: 'Hora reserva',
              text: 'Solo puedes reservar una hora',
            });
          }
        }
        else {
          Swal.fire({
            icon: 'warning',
            title: 'Dia reserva',
            text: 'Tienes que escoger primero el dia',
          });
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
            fetch("http://peluqueriahappyback.alumnes.inspedralbes.cat/reservas/nueva/reserva", {
              method: "POST",
              body: datosEnvio
            }).then(function (res) {
              return res.json();
            }).then(function (data) {
              console.log(data);
              Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: 'Reserva acceptada',
                showConfirmButton: false,
                timer: 1500
              });
            });
          }
          else {
            Swal.fire({
                title: 'Dia y hora reserva',
                text: 'Porfavor escoga un dia y hora',
                icon: 'warning'
            });
          }
        }
        else {
          Swal.fire({
            title: 'Iniciar sesion',
            text: "Tienes que iniciar sesion para poder comprar",
            icon: 'warning',
          });
        }
      },
    },
    components: { Navegador }
}
</script> 

<style>
  h2 {
    margin-left: 20%;
    color: white;
  }
  #title-reserva {
    color: white;
    text-align: center;
  }
  #servicios {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    margin-left: 50px;
  }
  #precio_total {
      margin-left: 50%;
      color: white;
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
  .card-title, .card-text{
    color: black;
  }
  .card {
    margin: 5px;
  }
  .btn-descartar {
    display: none;
    margin-left: 6rem;
  }
  #horas {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    column-gap: 20px;
    margin-top: 50px;
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
    .btn-descartar {
      margin-left: 4rem;
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
      margin-left: 45%;
    }
    .btn-descartar {
      margin-left: 3.5rem;
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
      margin-left: 40%;
    }
    .btn-descartar {
      margin-left: 1rem;
    }
  }
</style>