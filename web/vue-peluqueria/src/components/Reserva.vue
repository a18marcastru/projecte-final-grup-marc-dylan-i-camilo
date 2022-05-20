<template>
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
              <button class="btn btn-success" :id="ses.id+'c'" @click="anadido(ses.nombre_servicio, ses.id)" hidden>Añadido</button>
            </div>
          </div>
        </div>
      </div>
      <h2>Fecha {{this.mes}}</h2>
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
      <h2>Hora</h2>
      <div>
        
      </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
              datos: [],
              total: [],
              email: '',
              mes: '',
              dia: 0
            }
        },
        mounted() {
          fetch(`http://192.168.210.154:8000/servicios/mostrar`)
          .then(res => res.json())
          .then((data) => {
            this.datos = data;
            console.log(data);
          });

          const month = ["Junio","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
          const d = new Date()
          this.mes = month[d.getUTCMonth()];
        },
        methods: {
          anadir(nombre, precio, id) {
            console.log("Hola");
            let encontrado = false;
            for(let i = 0;i < this.total.length;i++) {
              if(this.total[i].nombre_servicio == nombre) {
                encontrado = true;
              }
            }
            if(encontrado == false) {
              this.total.push({'nombre_servicio': nombre});
              document.getElementById(id+'c').removeAttribute("hidden");
              document.getElementById(id).setAttribute("style","display: none;");
            }
            console.log(this.total);
          },
          anadido(nombre, id) {
            console.log("Hola2");
            for(let i = 0;i < this.total.length;i++) {
              if(this.total[i].nombre_servicio == nombre) {
                this.total = this.total.filter(obj => obj.nombre_servicio != nombre);
                document.getElementById(id+'c').setAttribute("style","display: none;");
                document.getElementById(id).removeAttribute("style","display: none;");
              }
            }
            console.log(this.total);
          },
          fecha(index) {
            this.dia = index;
            document.getElementById(index+'p').setAttribute("style","background: green;");
            console.log(this.dia);
          },
          reserva() {
            document.getElementById("nombre_servicio").value
            console.log(this.email + " " + this.nombre_servicio + " " + this.dia + " " + this.hora + " " + this.precio_total);
            const servicio = JSON.stringify(this.datos);
            const datosEnvio = new FormData();
            datosEnvio.append('email', this.email);
            datosEnvio.append('nombre_servicio', this.nombre_servicio);
            datosEnvio.append('dia', this.dia);
            datosEnvio.append('hora', this.hora);
            datosEnvio.append('precio_total', this.datos);

            fetch('http://localhost:8000/reservas/nueva/reserva', {
              method: 'POST',
              body: datosEnvio
            }).then(function(res){
              return res.json();
            }).then(function(data){
              console.log(data)
            });
          },            
      },
    }
</script> 

<style>
  #reservas {
    display: grid;
    grid-template-columns: repeat(3,1fr);
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
</style>