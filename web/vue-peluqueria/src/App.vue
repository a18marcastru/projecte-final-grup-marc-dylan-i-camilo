<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import { sessioStore } from '@/stores/sessioStore'
  import { mapStores } from 'pinia'
  import Nav from "@/components/Navegador.vue"
  import Login from "@/components/Login.vue";
</script>

<template>
  <header>
    <Nav/>
  </header>
  <RouterView />
</template>

<style>
@import "@/assets/base.css";

</style>
