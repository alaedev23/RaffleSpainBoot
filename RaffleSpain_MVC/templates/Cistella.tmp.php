
<?= (isset($template)) ? $template : '' ?>

<script>
function guardarCantidadYtalla(productId) {
    var cantidadInput = document.getElementById('cantidad-' + productId);
    var tallaInput = document.getElementById('talla');
    var nuevaCantidad = cantidadInput.value;
    var nuevaTalla = tallaInput.value;
    
    if (nuevaCantidad > 0) {
        window.location.href = "?Cistella/updateCantidadTalla/" + productId + "/" + nuevaCantidad + "/" + nuevaTalla;
    } else {
        window.location.href = "?Cistella/removeProductById/" + productId;
    }
}


</script>
