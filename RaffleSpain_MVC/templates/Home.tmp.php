<section id="banner" class="animated-section-left-right animation">
    <img src="../public/img/banner.jpg" alt="Banner">
</section>
<section id="tendencies">
    <h1 class="animated-section-left-right animation">Tendencias de Zapatillas</h1>

<?php
foreach ($products as $product) {

    echo '
    <div class="zapatilla animated-section-left-right animation">
        <a href="?Producte/mostrarProducte/' . $product->id . ' ">
            <img src="public/img/vambas/' . $product->img . '" alt="' . $product->name . '">
            <p class="nombre_zapatilla">' . $product->brand . ' ' . $product->name . '</p>
            <p class="sexo_zapatilla">' . generateSex($product->sex) . '</p>
            <p class="precio">' . $product->price . ' €</p>
        </a>
    </div>';
}

function generateSex($sex) {
    if ($sex == 'H') {
        return 'Hombre';
    } else if ($sex == 'M') {
        return 'Mujer';
    } else {
        return 'Niño';
    }
}
?>
</section>
<section id="rifes" class="animated-section-right-left animation">
    <h1>Rifes</h1>
    <div id="contenidor_rifes">
        <div class="zapatilla">
            <img src="../public/img/zapatillas1.jpeg" alt="Zapatilla 1">
            <p class="nombre_zapatilla">Nombre zapatilla</p>
            <p class="sexo_zapatilla">Sexo zapatilla</p>
            <p class="precio">100,00 €</p>
            <button class="btn btnZapatillas">Añadir Cesta</button>
        </div>
        <div class="zapatilla">
            <img src="../public/img/zapatillas1.jpeg" alt="Zapatilla 1">
            <p class="nombre_zapatilla">Nombre zapatilla</p>
            <p class="sexo_zapatilla">Sexo zapatilla</p>
            <p class="precio">100,00 €</p>
            <button class="btn btnZapatillas">Añadir Cesta</button>
        </div>
        <div class="zapatilla">
            <img src="../public/img/zapatillas1.jpeg" alt="Zapatilla 1">
            <p class="nombre_zapatilla">Nombre zapatilla</p>
            <p class="sexo_zapatilla">Sexo zapatilla</p>
            <p class="precio">100,00 €</p>
            <button class="btn btnZapatillas">Añadir Cesta</button>
        </div>
    </div>
</section>