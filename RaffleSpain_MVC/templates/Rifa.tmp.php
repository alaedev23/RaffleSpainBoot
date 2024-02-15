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
                <img src="<?= 'public/img/vambas/' . $rifa->producte->img; ?>" alt="Zapatilla 2">
                <img src="<?= 'public/img/vambas/' . $rifa->producte->img; ?>" alt="Zapatilla 2">
                <img src="<?= 'public/img/vambas/' . $rifa->producte->img; ?>" alt="Zapatilla 2">
                <img src="<?= 'public/img/vambas/' . $rifa->producte->img; ?>" alt="Zapatilla 2">
            </div>
            <div id="imagenPrincipal">
                <img src="<?= 'public/img/vambas/' . $rifa->product->img; ?>" alt="Zapatilla 1">
            </div>
        </div>
        <div id="infoProducto">
        <h1><?= str_replace('-', ' ', $rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) ?></h1>
            <h1><?= $rifa->$product->price . ' €' ?></h1>
            <button class="btn">Participar en la rifa</button>
        </div>
    </section>

