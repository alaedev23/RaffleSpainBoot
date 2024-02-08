<?php

class RaffleView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function showView($raffle, $lang, $errors = null) {
        
        $rifas = self::generarRaffle($raffle);
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo $rifas;
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    public static function generarRaffle($raffle) {
        
        $templateProduct = "<section class=\"containerProductos\">";
        $templateProduct .= Functions::generatecardRaffle($raffle);
        $templateProduct .= "</section>";
        return $templateProduct;
        
    }
    
}