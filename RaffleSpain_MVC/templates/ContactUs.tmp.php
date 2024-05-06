<div id="contactUs" style="height: calc(100vh - 222px);">
	<h1>Contact Us</h1>
    <div class="form-container">
        <form action="?contact/verifyForm" class="form" method="post">
            <div class="form-group">
                <label for="tituloContactUs">Titulo</label>
                <input type="text" name="tituloContactUs" id="tituloContactUs">
            </div>
            <div class="form-group">
                <label for="mensajeContactUs">Mensaje</label>
                <textarea name="mensajeContactUs" id="mensajeContactUs" cols="30" rows="10"></textarea>
            </div>
            <?php 
            if (!isset($_SESSION['usuari']) || $_SESSION['usuari']->type == 0) {
                echo '
                    <div class="form-group">
                        <label for="emailContactUs">Email</label>
                        <textarea name="emailContactUs" id="emailContactUs" cols="30" rows="10"></textarea>
                    </div>
                ';
            }?>
            <button class="btn" name="sendContactUs" type="submit">Enviar</button>
        </form>
       	<?= ($send) ? "<div style='margin-top: 20px;' class=\"correctMessage\"><p>Mail enviado correctamnete. Pronto nos pondremos en contacto contigo!</hp></div>" : ''; ?>
        <?= ($errors !== '') ? "<div style='margin-top: 20px;' class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
    </div>
</div>