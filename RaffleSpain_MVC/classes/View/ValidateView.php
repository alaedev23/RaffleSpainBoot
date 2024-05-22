<?php

/**
 * Clase ValidateView
 *
 * Esta clase se utiliza para mostrar vistas relacionadas con la validación de cuentas de usuario.
 */
class ValidateView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Muestra la vista de validación de cuenta.
     *
     * @param string $email Correo electrónico al que se envió el enlace de validación.
     */
    public static function show($email) {

        $mensaje = "Debes validar tu cuenta para poder acceder a la web. Se ha enviado un correo a la dirección $email con un enlace para validar el usuario.";

        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Validate.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    /**
     * Muestra la vista de validación exitosa.
     *
     * @param string $email Correo electrónico del usuario validado.
     */
    public static function showCorrectValidate($email) {

        $mensaje = "El usuario con email $email se ha validado correctamente";

        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Validate.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
  
}