
<div class="cistella">
    <h1>Favoritos</h1>
    <ul class="cistella-list">
        <?php 
        $total = 0;
        if (isset($carretoProducts) && !empty($carretoProducts)) { 
            foreach ($carretoProducts as $carretoProduct) {
        ?>
                <li class="product">
                    <img src="<?= 'public/img/vambas/' . $carretoProduct->product->img; ?>" alt="<?= $carretoProduct->product->name; ?>">
                    <div class="product-info">
                        <h3><?= $carretoProduct->product->name; ?></h3>
                        <p><?= $carretoProduct->product->description; ?></p>
                        <p class="precio"><?php echo $carretoProduct->product->price; ?> €</p>
                        <a href="?Favoritos/removeProductById/<?= $carretoProduct->product->id; ?>" class="btn btnZapatillas">Quitar Favorito</a>
                    </div>
                </li>
        <?php
            }
        ?>
            <div class="precio-total">
                <a href="?Favoritos/emptyCart" class="btn btnZapatillas">Vaciar favoritos</a>
            </div>
        <?php 
        } else {
            echo "<p class=\"emptycistella\">No hay productos en la cesta</p>";
        } ?>
    </ul>
</div>
