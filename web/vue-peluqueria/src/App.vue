<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
import Login from "@/components/Login.vue";
</script>


<template>
  <header>
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <button id="perfil" hidden>Perfil</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Login
        </button>
      </nav>
  </header>
  <Login />
  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
