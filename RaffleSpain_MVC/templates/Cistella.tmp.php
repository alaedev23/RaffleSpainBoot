
<div class="cistella">
    <h1>Mi Cesta</h1>
    <ul class="cistella-list">
        <?php 
        $total = 0;
        if (isset($carretoProducts) && !empty($carretoProducts)) { 
            foreach ($carretoProducts as $carretoProduct) {
                $total += $carretoProduct->product->price * $carretoProduct->quantity;
        ?>
                <li class="product">
                    <img src="<?= 'public/img/vambas/' . $carretoProduct->product->img; ?>" alt="<?= $carretoProduct->product->name; ?>">
                    <div class="product-info">
                        <h3><?= $carretoProduct->product->name; ?></h3>
                        <p><?= $carretoProduct->product->description; ?></p>
                        <p class="precio"><?php echo $carretoProduct->product->price; ?> €</p>
                        <input type="number" id="cantidad-<?= $carretoProduct->product->id; ?>" value="<?= $carretoProduct->quantity; ?>">
                        <a href="#" onclick="guardarCantidad(<?= $carretoProduct->product->id; ?>)" class="btn btnZapatillas">Guardar Cantidad</a>
                        <a href="?Cistella/removeProductById/<?= $carretoProduct->product->id; ?>" class="btn btnZapatillas">Quitar Cesta</a>
                    </div>
                </li>
        <?php
            }
        ?>
            <div class="precio-total">
                <p>Total: <?= number_format($total, 2); ?> €</p>
                <a href="?Cistella/emptyCart" class="btn btnZapatillas">Vaciar carrito</a>
                <button class="btn btnZapatillas">Tramitar Pago</button>
            </div>
        <?php 
        } else {
            echo "<p class=\"emptycistella\">No hay productos en la cesta</p>";
        } ?>
    </ul>
</div>

<script>
    function guardarCantidad(productId) {
        var cantidadInput = document.getElementById('cantidad-' + productId);
        var nuevaCantidad = cantidadInput.value;
        window.location.href = "?Cistella/updateCantidad/" + productId + "/" + nuevaCantidad;
    }
</script>
