<?php

class ProductSexView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showView($lang, $sexo, $productos, $errors = null) {
        
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

        $templateProduct = "<section class=\"containerProductos\">";
        $templateProduct .= Functions::generatecardProduct($productos);
        $templateProduct .= "</section>";
        return $templateProduct;
        
    }
    
}