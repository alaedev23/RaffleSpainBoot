<?php

/**
 * Clase HomeView
 *
 * Esta clase se utiliza para mostrar la vista de la página de inicio.
 */
class HomeView extends View {
    
    /**
     * Muestra la vista de la página de inicio.
     *
     * @param array $products Los productos a mostrar en la página de inicio.
     * @param array $rifas Las rifas a mostrar en la página de inicio.
     */
    public static function show($products, $rifas) {

        $function = new Functions();
        $productsGrid = $function->generatecardProduct(array_slice($products, 0, 6));
        $rifasGrid = $function->generatecardRaffle(array_slice($rifas, 0, 3));
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Home.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}

