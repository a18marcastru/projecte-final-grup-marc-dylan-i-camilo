<template>
<div class="inicio" >
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" >
      <img src="/buzz.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
      <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte "buzz"</mark></h5>
        <p> <mark>La esencia de este corte reside en llevar el cabello muy corto y, de manera general, uniforme, con la misma longitud en toda la cabeza</mark></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="/fade.jpg"   class="d-block w-100" alt="..."  height="600px" width="800px">
      <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte "fade"</mark></h5>
        <p> <mark> El corte fade consiste en hacer una disminución del corte desde el número más corto pedido por el cliente y, a partir de ahí, ir subiendo.</mark></p>
      </div>
    </div>
    <div class="carousel-item" height="400px" width="400px">
      <img src="/mullet.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
      <div class="carousel-caption d-none d-md-block">
       <h5><mark>Corte "mullet"</mark></h5>
       <p> <mark>Se caracteriza por sus dos extensiones bien marcadas: más corto arriba y a los lados, y más largo detrás. Su aspecto varía según el flequillo con el que se use y el largo</mark></p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
</template>

<style>

.carousel carousel-dark slide{
    height: 800px;
    width: 800px;
}
.inicio{
    height: 800px; 
    width: 800px;
    margin: auto;
    width: 60%;
    border: 5px;
    padding: 10px;
}
mark{
  background-color: white;
}

</style>