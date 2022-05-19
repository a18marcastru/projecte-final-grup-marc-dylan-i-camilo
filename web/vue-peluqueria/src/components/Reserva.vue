<template>

    <div class="principal">
        <h2>Reserva</h2>
        <p>SELECCIONAR SERVICIO(S) Y EMPLEADO(S)
        Skip Navigation LinksSELECCIÓN DEL CENTRO > SELECCIONAR SERVICIOS</p>

        <p>Paso 1: Seleccionar la  categoría del servicio desde el menú desplegable Categoría y luego seleccione el servicio desde el menú desplegable Servicio.</p>
        <p>Elige hora.</p>
        <p>Una vez termine de seleccionar  todos los servicios y empleados haga clik en Siguiente  para continuar.</p>
 

      <label for="email"><b>email</b></label>
      <input  v-model="email" type="text" placeholder="email" name="email" id="email" required><br><br>

        <div>
        <select id="Reserva">
            <option selected>Reserva</option>
            <option id="nombre_servicio" value="30">Corte de pelo</option>
            <option id="nombre_servicio" value="10">Teñir</option>
        </select>
        <br>

        	<div>Picked: {{ picked }}</div>

        <input type="radio" id="dia" value="1" v-model="picked" />
        <label for="1">Lunes</label>

        <input type="radio" id="dia" value="Two" v-model="picked" />
        <label for="two">martes</label>
          <input type="radio" id="dia" value="tre" v-model="picked" />
        <label for="tre">miercoles</label>

        <input type="radio" id="dia" value="cat" v-model="picked" />
        <label for="cat">jueves</label>
          <input type="radio" id="dia" value="fiv" v-model="picked" />
        <label for="fiv">viernes</label>

        <input type="radio" id="dia" value="six" v-model="picked" />
        <label for="six">sabado</label>
          <input type="radio" id="dia" value="seve" v-model="picked" />
        <label for="seve">domingo</label>

        </div>

          <select id="hora">
            <option selected>Hora</option>
            <option id="hora" value="10:00">10:00</option>
            <option id="hora" value="11:00">11:00</option>
            <option id="hora" value="12:00">12:00</option>
            <option id="hora" value="13:00">13:00</option>
            <option id="hora" value="14:00">14:00</option>
            <option id="hora" value="15:00">15:00</option>
            <option id="hora" value="16:00">16:00</option>
            <option id="hora" value="17:00">17:00</option>
            <option id="hora" value="18:00">18:00</option>
            <option id="hora" value="19:00">19:00</option>
            <option id="hora" value="20:00">20:00</option>
        </select>
        <br>   
        <br>
        <br>
        <div id="confirmarReserva">
          <button class="btn btn-primary" id="btn-reserva" @click="reserva()">Reservar</button><hr>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                nombre_servicio: '',
                dia: '',
                hora: '',
                precio_total: '',
                picked : 'One'
            }
        },
        mounted() {
          fetch(`http://192.168.210.154:8000/servicios/mostrar`)
          .then(res => res.json())
          .then((data) => {
            this.datos = data;
            console.log(this.datos);
          });
        },
        methods: {
            reserva() {
                console.log(this.precio_total);
                const nombre_servicio = JSON.stringify(this.precio_total);
                const datosEnvio = new FormData();
                datosEnvio.append('email', this.email);
                datosEnvio.append('nombre_servicio', nombre_servicio);
                datosEnvio.append('dia', this.dia);
                datosEnvio.append('hora', this.hora);
                datosEnvio.append('precio_total', this.precio_total);
                console.log(this.email + " " + this.nombre_servicio + " " + this.dia + " " + this.hora + " " + this.precio_total);

                fetch('http://192.168.210.154:8000/reservas/nueva/reserva', {
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
  .principal{
      text-align: center;
  }
  .form-select{
      width: 150px;
      padding: 0px;
      margin: 0px;
  }
</style>