<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import Login from "@/components/Login.vue";
</script>

<template>
  <header>
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink class="btn btn-outline-primary" to="/">Home</RouterLink>
        <RouterLink class="btn btn-outline-primary" to="/register">Registro</RouterLink>
        <RouterLink class="btn btn-outline-primary" to="/tienda">tienda</RouterLink>

        <Login />
      </nav>
  </header>
  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
