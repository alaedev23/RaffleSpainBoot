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
        <h1><?= str_replace('-', ' ', $producte->brand) . ' ' . str_replace('-', ' ', $producte->name) ?></h1>
            <h3><?= $funciones->generateSex($producte->sex) . ' - ' . $producte->color ?></h3>
            <div id="tallasProducto">
                <?= $funciones->generateTallas($tallas) ?>
            </div>
            <h1><?= $producte->price . ' €' ?></h1>
            <button class="btn">Añadir a la cesta</button>
        </div>
    </section>
    <section id="comentarioProducto">
        <h1>Comentario</h1>
        <div class="comentari">
            
        </div>
        <p>Ejemplo de comentario</p>
    </section>

