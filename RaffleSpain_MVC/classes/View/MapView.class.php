<?php

class MapView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showMap($lang, $errors = null) {
        $fitxerDeTraduccions = "languages/{$this->lang}_traduccio.php";
        include $fitxerDeTraduccions;
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Ayuda.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
}

