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
  body {
    background-image: url("/img1.jpg ");
    background-position: top left;
    background-attachment: fixed;
    width: 100%;
    height: 100%;
      background-repeat: no-repeat;
background-size: cover;
    
  }
  
    img{
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}
  
</style>
