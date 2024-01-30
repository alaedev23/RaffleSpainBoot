<?php

class ProductSexView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showMap($lang, $sexo, $productos, $errors = null) {
        $fitxerDeTraduccions = "languages/{$this->lang}_traduccio.php";
        include $fitxerDeTraduccions;
        
        $proctos = self::generarProductos($sexo, $productos);
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo $proctos;
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    public static function generarProductos($sexo, $productos, $errors = null) {

        
        
    }
    
}