<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import Login from "@/components/Login.vue";
  import Footer from "@/components/Footer.vue";
</script>

<template>
  <header>
      <nav class="navbar navbar-dark bg-dark" style="background-color: #e3f2fd;">
        <img class="logo" src="/logo.png"/>
        <RouterLink class="btn btn-dark" to="/">Home</RouterLink>
        <RouterLink class="btn btn-dark" to="/tienda">Tienda</RouterLink>
        <RouterLink class="btn btn-dark" to="/reserva">Reserva</RouterLink>
        <RouterLink class="btn btn-dark " to="/register">Registro</RouterLink>
        <Login />
      </nav>
  </header>
  <RouterView />
  <Footer />
</template>

<style>
  @import "@/assets/base.css";

  .logo {
    width: 200px;
  }
</style>
