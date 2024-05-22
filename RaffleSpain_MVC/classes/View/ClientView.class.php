<?php

/**
 * Clase que representa la vista del cliente.
 */
class ClientView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la interfaz de inicio de sesión.
     *
     * @param bool   $login  Estado de inicio de sesión.
     * @param string $lang   Idioma de la interfaz.
     * @param array  $errors Posibles errores a mostrar.
     */
    public static function showLogin($login, $lang, $errors=null) {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Login.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
    /**
     * Muestra la interfaz de registro.
     *
     * @param bool   $register Estado de registro.
     * @param string $lang     Idioma de la interfaz.
     * @param array  $errors   Posibles errores a mostrar.
     */
    public static function showRegister($register, $lang, $errors=null) {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Register.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
}

?>