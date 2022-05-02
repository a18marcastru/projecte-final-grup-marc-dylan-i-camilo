<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
</script>


<template>
  <header>
      <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
  </header>

  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
