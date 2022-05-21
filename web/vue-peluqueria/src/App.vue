<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import Login from "@/components/Login.vue";
  import Footer from "@/components/Footer.vue";
</script>

<template>
  <RouterView />
  <Footer />
</template>

<style>
  @import "@/assets/base.css";

  .logo {
    width: 200px;
  }
</style>
