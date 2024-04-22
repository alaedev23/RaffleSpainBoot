
<?= (isset($template)) ? $template : '' ?>

<script>
    function guardarCantidad(productId) {
        var cantidadInput = document.getElementById('cantidad-' + productId);
        var nuevaCantidad = cantidadInput.value;
        if (nuevaCantidad > 0) {
        	window.location.href = "?Cistella/updateCantidad/" + productId + "/" + nuevaCantidad;
        } else {
        	window.location.href = "?Cistella/removeProductById/" + productId
        }
    }
</script>
