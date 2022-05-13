<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import Login from "@/components/Login.vue";
  import Comentario from "@/components/Comentario.vue";
  import Review from "@/components/Review.vue";
</script>

<template>
  <header>
    
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink class="btn btn-outline-primary" to="/">Home</RouterLink>
        <RouterLink class="btn btn-outline-primary" to="/register">Registro</RouterLink>
        <Login />
      </nav>
  </header>
  <RouterView />
  <Comentario/>
    <Review/>
</template>

<style>
@import "@/assets/base.css";

</style>
