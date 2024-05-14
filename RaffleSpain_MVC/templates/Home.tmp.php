<section id="banner" class="animated-section-left-right animation">
    <!-- <div class="container">
    	<div class="slideshow">
    		<div id="slide-1" class="slide">
    			<a href="#slide-7"></a>
    			<a href="#slide-2"></a>
    			<img src="public/img/slider/img1.jpg" />
    		</div>
    		<div id="slide-2" class="slide">
    			<a href="#slide-1"></a>
    			<a href="#slide-3"></a>
    			<img src="public/img/slider/img2.jpeg" />
    		</div>
    		<div id="slide-3" class="slide">
    			<a href="#slide-2"></a>
    			<a href="#slide-4"></a>
    			<img src="public/img/slider/img3.jpg" />
    		</div>
    		<div id="slide-4" class="slide">
    			<a href="#slide-3"></a>
    			<a href="#slide-5"></a>
    			<img src="public/img/slider/img4.jpg" />
    		</div>
    	</div>
	</div> -->
	<div class="center">
  <div class="carousel-wrapper">
    <!-- abstract radio buttons for slides -->
    <input id="slide1" type="radio" name="controls" checked="checked" />
    <input id="slide2" type="radio" name="controls" />
    <input id="slide3" type="radio" name="controls" />
    <input id="slide4" type="radio" name="controls" />
    <input id="slide5" type="radio" name="controls" />

    <!-- navigation dots -->
    <label for="slide1" class="nav-dot"></label>
	<label for="slide2" class="nav-dot"></label>
	<label for="slide3" class="nav-dot"></label>
	<label for="slide4" class="nav-dot"></label>
	<label for="slide5" class="nav-dot"></label>

    <!-- arrows -->
    <label for="slide1" class="left-arrow"> < </label>
    <label for="slide2" class="left-arrow"> < </label>
    <label for="slide3" class="left-arrow"> < </label>
    <label for="slide4" class="left-arrow"> < </label>
    <label for="slide5" class="left-arrow"> < </label>

    <label for="slide1" class="right-arrow"> > </label>
    <label for="slide2" class="right-arrow"> > </label>
    <label for="slide3" class="right-arrow"> > </label>
    <label for="slide4" class="right-arrow"> > </label>
    <label for="slide5" class="right-arrow"> > </label>

    <div class="carousel">
      <ul>
        <li>
          <img src="public/img/slider/fondo1.jpeg"" alt="" />
        </li>
        <li>
          <img src="public/img/slider/fondo2.jpg" alt="">
        </li>
        <li>
          <img src="public/img/slider/fondo3.avif"" />
        </li>
        <li>
          <img src="public/img/slider/fondo4.jpg">
        </li>
        <li>
          <img src="public/img/slider/fondo5.jpeg" alt="">
        </li>
      </ul>
    </div>
  </div>
</div>
</section>
<section class="containerProductos">
    <h1 class="animated-section-left-right animation">Zapatillas</h1>

<?= $productsGrid ?>
</section>
<section id="rifes" class=" containerProductos animated-section-right-left animation">
    <h1>Rifas</h1>
    <?= $rifasGrid ?>
    </div>
</section>