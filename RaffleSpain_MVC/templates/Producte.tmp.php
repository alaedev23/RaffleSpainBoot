<section id="producto">
    <div id="fotosProducto">
        <div id="imagenPrincipal">
            <img src="<?= 'public/img/vambas/' . $producte->img; ?>" alt="Zapatilla 1">
        </div>
    </div>
    <div id="infoProducto">
        <form method="post" action="?Cistella/addProduct/<?= $producte->id ?>">
            <h1>
                <?= str_replace('-', ' ', $producte->brand) . ' ' . str_replace('-', ' ', $producte->name) ?>
            </h1>
            <p class="descrpcion-producto"><?= $producte->description ?></p>
            <h3>
                <?= Functions::generateSex($producte->sex) . ' - ' . $producte->color ?>
            </h3>
            <div id="tallasProducto">
                <?= Functions::generateTallas($tallas) ?>
            </div>
            <h1>
                <?php
                    echo '<span class="precio">' . $producte->price . ' €</span>';
                ?>
            </h1>
            <div class="actions">
                <button class="btn" name="cesta" type="submit">Añadir a la cesta</button>
                <?php if (!isset($_SESSION['usuari'])) { ?>
                    <a href="index.php?client/formLogin"> <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                        </svg></a>
                <?php } else if ($enFavoritos) { ?>
                        <a href="?favoritos/addProduct/<?= $producte->id ?>">
                            <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" viewBox="0 0 24 24">
                                <path
                                    d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                            </svg>
                        </a>
                <?php } else { ?>
                        <a href="?favoritos/addProduct/<?= $producte->id ?>">
                            <svg class="w-[32px] h-[32px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="gray" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                        </a>
                <?php } ?>
            </div>
        </form>
    </div>
</section>
<div class="containerError">
    <?= $errors !== '' ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
</div>
<section id="comentarioProducto">
    <?php
    echo '<div class="headerComentario"><h1>Comentarios</h1><svg id="openModalBtn" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus addComment" viewBox="0 0 16 16">
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg></div>';
    if ($getComments !== null && count($getComments) > 0) {
        echo Functions::generatecardComment($getComments);
    } else {
        echo '<h1>Aun no hay comentarios para esta zapatilla.</h1>';
    }
    echo $generateAddComment;
    ?>
</section>