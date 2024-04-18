
<?= (isset($template)) ? $template : '' ?>

<script>
    function guardarCantidad(productId) {
        var cantidadInput = document.getElementById('cantidad-' + productId);
        var nuevaCantidad = cantidadInput.value;
        window.location.href = "?Cistella/updateCantidad/" + productId + "/" + nuevaCantidad;
    }
</script>
