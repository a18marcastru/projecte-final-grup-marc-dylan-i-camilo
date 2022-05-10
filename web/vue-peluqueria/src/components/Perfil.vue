<template>
    <div id="perfil">
        <div v-if="error">
            Hey, hay un error!!!!
        </div>
        <div v-else>
            <div v-if="loading">loading...</div>
            <div v-else>
                <h1>Perfil de Usuario</h1>
                {{registro}}    
            </div>
        </div>
    </div>
</template>

<script>
    var perfil = new Vue({
        el: '#perfil',
        data() {
            return {
                registro: '',
                loading: true,
                error: false,
            } 
        },
        mounted() {
            fetch(`http://192.168.210.153:8000/usuarios/perfil/${}`)
            .then(response => {
                this.registro = response.data.data[0]
                console.log(response)
            })
            .catch(error => {
                console.log(error)
                this.error = true
            })
            .finally(() => {
                this.loading = false
            })
        }
    })
</script>