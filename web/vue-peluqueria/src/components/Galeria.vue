<template>
<div class="inicio" >
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"></button>
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
          <p> <mark> El corte fade consiste en hacer una disminución del corte desde el número más corto pedido por el cliente y, a partir de ahí, ir subiendo</mark></p>
        </div>
      </div>
      <div class="carousel-item" height="400px" width="400px">
        <img src="/mullet.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
        <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte "mullet"</mark></h5>
        <p> <mark>Se caracteriza por sus dos extensiones bien marcadas: más corto arriba y a los lados, y más largo detrás. Su aspecto varía según el flequillo con el que se use y el largo</mark></p>
        </div>
      </div>
      <div class="carousel-item" height="400px" width="400px">
        <img src="/corte_wob.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
        <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte "WOB"</mark></h5>
        <p> <mark>Es el corte ideal para pelos ondulados. Con una base cuadrada y a la altura de la mandíbula baja. Está a medio camino entre el carré y la melena midi y su característica principal es la textura wavy o ondulada</mark></p>
        </div>
      </div>
      <div class="carousel-item" height="400px" width="400px">
        <img src="/corte_acapas.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
        <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte a capas o degradada</mark></h5>
        <p> <mark>Está en tu mano elegir el largo de las capas, cuanto más cortas más volumen pero menos densidad en puntas. En el término medio está el acierto</mark></p>
        </div>
      </div>
      <div class="carousel-item" height="400px" width="400px">
        <img src="/corte_lob.jpg" class="d-block w-100" alt="..." height="600px" width="700px">
        <div class="carousel-caption d-none d-md-block">
        <h5><mark>Corte "LOB"</mark></h5>
        <p> <mark>Es el corte estrellan para 2016.  Está a medio camino entre pertenecer a cortes de pelo medio o largo. Es la misma base que el estilo midi. Pero en este corte, la longitud del largo llega por debajo del hombro. Se recomienda degradar las puntas y el efecto effortless o despeinado es el que mejor le va</mark></p>
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