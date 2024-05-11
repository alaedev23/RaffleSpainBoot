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
          <img src="https://raw.githubusercontent.com/osef-art/osef-art.github.io/master/src/assets/wallpapers/canyon.jpg" />
        </li>
        <li>
          <img src="https://m.media-amazon.com/images/I/31Y+R3Y3nvL._SL1000_.jpg" alt="">
        </li>
        <li>
          <img src="https://raw.githubusercontent.com/osef-art/ministick/main/data/img/main/ministick-clip-3.gif" />
        </li>
        <li>
          <img src="https://raw.githubusercontent.com/osef-art/osef-art.github.io/master/src/assets/wallpapers/smoke.jpg">
        </li>
        <li>
          <img src="https://images.ctfassets.net/9l3tjzgyn9gr/photo-157575/d224d518da6c26515a470a9b7e490df8/157575-honey-bun-baby.jpg?fm=jpg&fl=progressive&q=50&w=1200" alt="">
        </li>
      </ul>
    </div>
  </div>
</div>
</section>
<section class="containerProductos"> <!-- style="padding-top: 500px;" -->
    <h1 class="animated-section-left-right animation">Zapatillas</h1>

<?= $productsGrid ?>
</section>
<section id="rifes" class=" containerProductos animated-section-right-left animation">
    <h1>Rifas</h1>
    <?= $rifasGrid ?>
    </div>
</section>