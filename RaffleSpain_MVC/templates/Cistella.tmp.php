
<div class="cistella">
    <h1>Mi Cesta</h1>
    <ul class="cistella-list">
        <?php 
            $total = 0;
            if (isset($carretoProducts)) { 
        ?>
            <?php  foreach ($carretoProducts as $producto) : ?>
                    <li class="product">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <div class="product-info">
                            <h3><?php echo $producto['nombre']; ?></h3>
                            <p><?php echo $producto['descripcion']; ?></p>
                            <p class="precio"><?php echo $producto['precio']; ?> €</p>
                            <button class="btn btnZapatillas">Quitar Cesta</button>
                        </div>
                    </li>
                    <div class="precio-total">
                        <p> Total: <?php $total ?> €</p>
                        <button class="btn btnZapatillas">Tramitar Pago</button>
                    </div>
                <?php $total .= $producto['precio']; endforeach; ?>
                <?php } else {
                    echo "<p class=\"emptycistella\">No hay productos en la cesta</p>";
            } ?>
    </ul>
</div>
