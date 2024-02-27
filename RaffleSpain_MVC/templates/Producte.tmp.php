<?php

$funciones = new Functions();

?>

<section id="search">
    <form method="get" role="search">
        <input type="search" class="inpSearch" placeholder="Search">
        <button class="btn" type="submit">Search</button>
    </form>
</section>
<section id="producto">
    <div id="fotosProducto">
        <div id="imagenesSecundarias">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 2">
        </div>
        <div id="imagenPrincipal">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 1">
        </div>
    </div>
    <div id="infoProducto">
        <h1>
            <?= str_replace('-', ' ', $producte->brand) . ' ' . str_replace('-', ' ', $producte->name) ?>
        </h1>
        <h3>
            <?= $funciones->generateSex($producte->sex) . ' - ' . $producte->color ?>
        </h3>
        <div id="tallasProducto">
            <?= $funciones->generateTallas($tallas) ?>
        </div>
        <h1>
            <?= $producte->price . ' €' ?>
        </h1>
        <div class="actions">
            <a class="btn" href="?cistella/addProduct/<?= $producte->id ?>" >Añadir a la cesta</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart"
                viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
            </svg>
        </div>
    </div>
</section>
<section id="comentarioProducto">
    <h1>Comentario</h1>
    <div class="comentari">

    </div>
    <p>Ejemplo de comentario</p>
</section>