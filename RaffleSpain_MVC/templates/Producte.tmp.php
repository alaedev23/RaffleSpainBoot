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
            <a class="btn" href="?cistella/addProduct/<?= $producte->id ?>">Añadir a la cesta</a>
            <?php if (!isset($_SESSION['usuari'])) { ?>
                <a href="index.php?client/formLogin">
                    <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg></a>
            <?php } else if ($enFavoritos) { ?>
                    <a href="?favoritos/addProduct/<?= $producte->id ?>">
                        <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" viewBox="0 0 24 24">
                            <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                        </svg>
                    </a>
            <?php } else { ?>
                    <a href="?favoritos/addProduct/<?= $producte->id ?>">
                        <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg>
                    </a>
            <?php } ?>
        </div>
    </div>
</section>
<section id="comentarioProducto">
    <h1>Comentario</h1>
    <div class="comentari">

    </div>
    <p>Ejemplo de comentario</p>
</section>