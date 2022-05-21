<template>
    <Navegador/>
    <div>
      <h1>Reserva un dia en la peluqueria</h1>
      <h2>Servicios</h2>
      <div id="reservas">
        <div v-for="ses in datos">
          <div class="card" style="width: 20rem;">
            <div class="card-body">
              <p class="card-title">{{ses.nombre_servicio}}</p>
              <p class="card-text">Precio : {{ses.precio}} €</p>
              <button class="btn btn-primary" :id="ses.id" @click="anadir(ses.nombre_servicio, ses.precio, ses.id)">Añadir</button>
              <button class="btn btn-success" :id="ses.id+'c'" @click="anadido(ses.nombre_servicio, ses.precio, ses.id)" hidden>Añadido</button>
            </div>
          </div>
        </div>
      </div>
      <h2>Fecha {{this.mes}}</h2>
      <div id="container-fecha">
        <div id="dias">
          <div>Lunes</div>
          <div>Martes</div>
          <div>Miercoles</div>
          <div>Jueves</div>
          <div>Viernes</div>
          <div>Sabado</div>
          <div>Domingo</div>
          <div v-for="index in 30">
            <div class="dia btn-primary" :id="index+'p'" @click="fecha(index)">{{index}}</div>
          </div>
        </div>
        <div id="horas">
          <div v-for="index in horas">
            <div class="dia btn-primary" :id="index.hora" @click="selecion_hora(index.hora)">{{index.hora}}</div>
          </div>
        </div>
      </div>
      <input v-model="email" type="text" placeholder="Email" name="email" id="email" required />
      <button class="btn btn-primary" @click="reservar()">Reservar</button>
    </div>
</template>

<script>
import Navegador from './Navegador.vue';
    export default {
    data() {
        return {
            datos: [],
            total: [],
            email: "",
            mes: "",
            hora: "",
            horas: [],
            dia: 0,
            precio_total: 0
        };
    },
    mounted() {
        fetch(`http://localhost:8000/servicios/mostrar`)
            .then(res => res.json())
            .then((data) => {
            this.datos = data;
            console.log(data);
        });
        const meses = ["Junio", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const d = new Date();
        this.mes = meses[d.getUTCMonth()];
        const horario = [{ "hora": "10:00" }, { "hora": "11:00" }, { "hora": "12:00" }, { "hora": "13:00" }, { "hora": "14:00" }, { "hora": "15:00" }, { "hora": "16:00" }, { "hora": "17:00" }, { "hora": "18:00" }, { "hora": "19:00" }];
        this.horas = horario;
        console.log(this.horas);
    },
    methods: {
        anadir(nombre, precio, id) {
            console.log("Hola");
            let encontrado = false;
            for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].nombre_servicio == nombre) {
                    encontrado = true;
                }
            }
            if (encontrado == false) {
                this.total.push({ "nombre_servicio": nombre });
                this.precio_total += precio;
                document.getElementById(id + "c").removeAttribute("hidden");
                document.getElementById(id).setAttribute("style", "display: none;");
            }
            console.log(this.total);
            console.log(this.precio_total);
        },
        anadido(nombre, precio, id) {
            console.log("Hola2");
            for (let i = 0; i < this.total.length; i++) {
                if (this.total[i].nombre_servicio == nombre) {
                    this.total = this.total.filter(obj => obj.nombre_servicio != nombre);
                    document.getElementById(id + "c").setAttribute("style", "display: none;");
                    document.getElementById(id).removeAttribute("style", "display: none;");
                    this.precio_total -= precio;
                    console.log(this.precio_total);
                }
            }
            console.log(this.total);
        },
        fecha(index) {
            this.dia = index;
            document.getElementById(index + "p").setAttribute("style", "background: green;");
            console.log(this.dia);
        },
        selecion_hora(hora) {
            this.hora = hora;
            document.getElementById(hora).setAttribute("style", "background: green;");
        },
        reservar() {
            console.log(this.email + " " + this.total + " " + this.dia + " " + this.hora + " " + this.precio_total);
            const servicio = JSON.stringify(this.total);
            const datosEnvio = new FormData();
            datosEnvio.append("email", this.email);
            datosEnvio.append("servicios", servicio);
            datosEnvio.append("dia", this.dia);
            datosEnvio.append("hora", this.hora);
            datosEnvio.append("mes", this.mes);
            datosEnvio.append("precio_total", this.precio_total);
            fetch("http://localhost:8000/reservas/nueva/reserva", {
                method: "POST",
                body: datosEnvio
            }).then(function (res) {
                return res.json();
            }).then(function (data) {
                console.log(data);
            });
        },
    },
    components: { Navegador }
}
</script> 

<style>
  #reservas {
    display: grid;
    grid-template-columns: repeat(3,1fr);
  }
  #container-fecha {
    display: flex;
  }
  #dias {
    display: grid;
    grid-template-columns: 10% 10% 10% 10% 10% 10% 10%;
    column-gap: 20px;
    row-gap: 20px;
  }
  .dia {
    border: 1px solid black;
    padding: 5px;
    font-size: 15px;
    text-align: center;
  }
  #horas {
    display: grid;
    grid-template-columns: 20% 20% 20% 20% 20%;
    column-gap: 20px;
    row-gap: 20px;
  }
</style>