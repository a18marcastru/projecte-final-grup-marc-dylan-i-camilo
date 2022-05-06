<template>
  <div class="hero-image">
    <div class="hero-text">
      <h1 style="font-size:50px">Peluquería Happy</h1>
    </div>
  </div>

</template>

<style>
body {
  margin: 0;
  padding: 0%;
  font-family: Arial, Helvetica, sans-serif;
}
.navbar navbar-light{
  margin: 0%;
  padding: 0%;
  background-color: aliceblue;

}
.hero-image {
  background-image: url("./salon.jpg");
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin: 0px;
  padding: 0%;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}
</style>
