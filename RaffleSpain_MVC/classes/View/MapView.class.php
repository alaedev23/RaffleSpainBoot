<?php

class MapView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showMap() {
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/MapaWeb.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
}

