
<?= (isset($template)) ? $template : '' ?>

<script>

function guardarCantidadYtalla(productId) {
    const cantidadInput = document.getElementById('cantidad-' + productId);
    const tallaInput = document.getElementById('talla');
    const nuevaCantidad = cantidadInput.value;
    const nuevaTalla = tallaInput.value;

    if (nuevaCantidad <= 0) {
        window.location.href = "?Cistella/removeProductById/" + productId;
    } else {
        window.location.href = "?Cistella/updateCantidadTalla/" + productId + "/" + nuevaCantidad + "/" + nuevaTalla;
    }
}

</script>
