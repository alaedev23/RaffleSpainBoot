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

        foreach ($productos as $product) {
            
            echo '
            <div class="zapatilla animated-section-left-right animation">
                <a href="?Producte/mostrarProducte/' . $product->id . ' ">
                    <img src="public/img/vambas/' . $product->img . '" alt="' . $product->name . '">
                    <p class="nombre_zapatilla">' . $product->brand . ' ' . $product->name . '</p>
                    <p class="sexo_zapatilla">' . generateSex($product->sex) . '</p>
                    <p class="precio">' . $product->price . ' €</p>
                </a>
            </div>';
        }
        
    }
    
}