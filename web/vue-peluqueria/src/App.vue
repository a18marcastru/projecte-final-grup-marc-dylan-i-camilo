<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
import Login from "@/components/Login.vue";
</script>


<template>
  <header>
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink class="btn btn-outline-primary" to="/">Home</RouterLink>
        <RouterLink class="btn btn-outline-primary" to="/register">About</RouterLink>
        <button id="perfil" hidden>Perfil</button>
        <RouterLink class="btn btn-outline-primary" to="/login">Login</RouterLink>

      </nav>
  </header>
  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
