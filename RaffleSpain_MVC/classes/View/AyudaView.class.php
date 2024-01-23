<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class AyudaView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showLogin($lang, $errors=null) {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Ayuda.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
}

?>