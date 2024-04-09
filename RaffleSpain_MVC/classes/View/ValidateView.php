<?php

class ValidateView extends View {
    public function __construct() {
        parent::__construct();
    }

    public static function show($email) {

        $mensaje = "Debes validar tu cuenta para poder acceder a la web. Se ha enviado un correo a la dirección $email con un enlace para validar el usuario.";

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Validate.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public static function showCorrectValidate($email) {

        $mensaje = "El usuario con email $email se ha validado correctamente";

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Validate.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
  
}