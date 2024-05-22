<?php

/**
 * Clase PayPalView
 *
 * Esta clase se utiliza para mostrar las vistas relacionadas con los pagos de PayPal.
 */
class PayPalView extends View {

    /**
     * Muestra la vista de pago realizado correctamente.
     */
    public static function showCorrect() {
        $mensaje = "Pago realizado correctamente";

        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Payment.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    /**
     * Muestra la vista de error en el pago.
     */
    public static function showError() {
        $mensaje = "Error en el pago";

        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Payment.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

}