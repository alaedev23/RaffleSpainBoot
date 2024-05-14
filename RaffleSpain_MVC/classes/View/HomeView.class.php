<?php

class HomeView extends View {
    
    public static function show($products, $rifas) {

        $function = new Functions();
        $productsGrid = $function->generatecardProduct(array_slice($products, 0, 6));
        $rifasGrid = $function->generatecardRaffle(array_slice($rifas, 0, 3));
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\"";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Home.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}

