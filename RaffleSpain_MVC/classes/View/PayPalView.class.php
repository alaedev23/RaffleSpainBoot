<?php

class PayPalView extends View {

    public static function showCorrect() {
        $mensaje = "Pago realizado correctamente";

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Payment.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public static function showError() {
        $mensaje = "Error en el pago";

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Payment.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

}