<?php

class Functions {
    
    public static function generatecardProduct($products) {
        // animated-section-left-right animation
        $result = '';
        foreach ($products as $product) {
            $result .= '
            <div class="zapatilla">
                <a href="?Producte/mostrarProducte/' . $product->id . ' ">
                    <img src="public/img/vambas/' . $product->img . '" alt="' . str_replace('-', ' ', $product->name) . '">
                    <p class="nombre_zapatilla">' . str_replace('-', ' ', $product->brand) . ' ' . str_replace('-', ' ', $product->name) . '</p>
                    <p class="sexo_zapatilla">' . self::generateSex($product->sex) . '</p>
                    <p class="precio">' . $product->price . ' €</p>
                </a>
            </div>';
        }
        return $result;
    }

    public static function generatecardRaffle($rifas) {

        $result = '';
        foreach ($rifas as $rifa) {
            $result .= '
            <div class="zapatilla">
                <a href="?Rifa/mostrarRifa/' . $rifa->id . ' ">
                    <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . str_replace('-', ' ', $rifa->product_id) . '">
                    <p class="nombre_zapatilla">' . str_replace('-', ' ', $rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                    <p class="date">' . $rifa->date_start . ' - ' . $rifa->date_end . '</p>
                </a>
            </div>';
        }
        return $result;
    }
    
    public static function generateSex($sex) {
        if ($sex == 'H') {
            return 'Hombre';
        } else if ($sex == 'M') {
            return 'Mujer';
        } else {
            return 'Niño';
        }
    }
    
    function generateTallas($tallas) {
        $tallasHTML = '';
        foreach ($tallas as $talla) {
            $tallasHTML .= '<button class="btn-talla">EU ' . $talla . ' </button>';
        }
        
        return $tallasHTML;
    }


    public static function replaceHyphen($string) {
        return str_replace($string,' ','-');
    }
    
}