<?php

/**
 * Clase que representa la vista de contacto.
 */
class ContactView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la interfaz del formulario de contacto.
     *
     * @param string $lang   Idioma de la interfaz.
     * @param bool   $send   Estado del envío del formulario.
     * @param string $errors Posibles errores a mostrar.
     */
    public static function show($lang, $send, $errors = '') {
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/ContactUs.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}
