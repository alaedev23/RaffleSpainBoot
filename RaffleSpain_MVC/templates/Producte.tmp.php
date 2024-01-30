
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
            <h1><?= $producte->brand . ' ' . $producte->name ?></h1>
            <h3><?= generateSex($producte->sex) . ' - ' . $producte->color ?></h3>
            <div id="tallasProducto">
                <?= generateTallas($tallas) ?>
            </div>
            <button class="btn">Añadir a la cesta</button>
        </div>
    </section>
    <section id="comentarioProducto">
        <h1>Comentario</h1>
        <div class="comentari">
            
        </div>
        <p>Ejemplo de comentario</p>
    </section>


<?php
    function generateSex($sex) {
        if ($sex == 'H') {
            return 'Hombre';
        } else if ($sex == 'M') {
            return 'Mujer';
        } else {
            return 'Niño';
        }
    }

    function generateTallas($tallas) {
        $tallasHTML = '';
        foreach ($tallas as $talla) {
            $tallasHTML .= '<button class="btn-talla">EU ' . $talla . ' </button>';
        }

        return $tallasHTML;
    }