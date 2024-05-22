<?php

/**
 * Clase que representa la vista de errores.
 */
class ErrorView extends View {

    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la interfaz de error.
     *
     * @param Exception $e Excepción que ha ocurrido.
     */
    public function show(Exception $e) {
        $fitxerDeTraduccions = "lang/{$this->lang}.php";
        include $fitxerDeTraduccions;
        
        $titol = "hi ha hagut un error";
        $missatge = $e->getMessage();
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
	    include "templates/Header.tmp.php";
		include "templates/Error.tmp.php";
		include "templates/Footer.tmp.php";
		echo "</body></html>";
    }
}

