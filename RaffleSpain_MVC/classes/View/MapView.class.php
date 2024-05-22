<?php

/**
 * Clase MapView
 *
 * Esta clase se utiliza para mostrar la vista del mapa del sitio.
 */
class MapView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la vista del mapa de la pagina web.
     */
    public static function showMap() {
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/MapaWeb.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
}

