<div class="cistella">
    <h1>Mis favoritos</h1>
    <ul class="cistella-list">
        <?php 
        $total = 0;
        if (isset($carretoProducts) && !empty($carretoProducts)) { 
            foreach ($carretoProducts as $producto) :
                $total += $producto['price'];
        ?>
                <li class="product">
                    <img src="<?= 'public/img/vambas/' . $producto['img']; ?>" alt="<?php echo $producto['name']; ?>">
                    <div class="product-info">
                        <h3><?= $producto['name']; ?></h3>
                        <p><?= $producto['description']; ?></p>
                        <p class="precio"><?php echo $producto['price']; ?> €</p>
                        <a href="?Cistella/removeProductById/<?= $producto['id']; ?>" class="btn btnZapatillas">Quitar Cesta</a>
                    </div>
                </li>
            <?php endforeach; ?>
            <div class="precio-total">
                <p>Total: <?= number_format($total, 2); ?> €</p>
                <a href="?Cistella/emptyCart" class="btn btnZapatillas">Vaciar carrito</a>
                <button class="btn btnZapatillas">Tramitar Pago</button>
            </div>
        <?php } else {
            echo "<p class=\"emptycistella\">No hay productos en la lista</p>";
        } ?>
    </ul>
</div>
