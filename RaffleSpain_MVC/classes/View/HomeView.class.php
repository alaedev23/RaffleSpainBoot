<?php

class HomeView extends View {
    
    public static function show($products) {

        $function = new Functions();
        $productsGrid = $function->generatecardProduct($products);
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Home.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}

