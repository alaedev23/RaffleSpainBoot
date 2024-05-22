<?php

/**
 * Clase que representa la vista de ayuda.
 */
class AyudaView extends View {
    
    /**
     * Constructor de la clase AyudaView.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la página de inicio de sesión de ayuda.
     *
     * @param string $lang   Idioma de la página.
     * @param array  $errors Lista de errores (opcional).
     */
    public static function showLogin($lang, $errors = null) {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Ayuda.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
}

?>
