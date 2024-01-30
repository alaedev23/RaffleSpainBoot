<?php

class Functions {
    
    public static function generateSex($sex) {
        if ($sex == 'H') {
            return 'Hombre';
        } else if ($sex == 'M') {
            return 'Mujer';
        } else {
            return 'Niño';
        }
    }
    
    public static function generatecardProduct($products) {
        $result = [];
        foreach ($products as $product) {
            $result .= '
            <div class="zapatilla animated-section-left-right animation">
                <a href="?Producte/mostrarProducte/' . $product->id . ' ">
                    <img src="public/img/vambas/' . $product->img . '" alt="' . $product->name . '">
                    <p class="nombre_zapatilla">' . $product->brand . ' ' . $product->name . '</p>
                    <p class="sexo_zapatilla">' . $this->generateSex($product->sex) . '</p>
                    <p class="precio">' . $product->price . ' €</p>
                </a>
            </div>';
        }
        return $result;
    }
    
}