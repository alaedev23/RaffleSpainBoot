<?php

use RdKafka\Producer;

class Functions {
    
    public static function generatecardProduct($products) {
        // animated-section-left-right animation
        $result = '';
        foreach ($products as $product) {
            $result .= '
            <div class="zapatilla">
                <a href="?Producte/mostrarProducte/' . $product->id . ' ">
                    <img src="public/img/vambas/' . $product->img . '" alt="' . self::replaceHyphenForSpace($product->name) . '">
                    <p class="nombre_zapatilla">' . self::replaceHyphenForSpace($product->brand) . ' ' . str_replace('-', ' ', $product->name) . '</p>
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
                <a href="?Raffle/showRaffle/' . $rifa->id . ' ">
                    <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . self::replaceHyphenForSpace($rifa->product_id) . '">
                    <p class="nombre_zapatilla">' . self::replaceHyphenForSpace($rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                    <p class="date">' . "Participa hasta el " . $rifa->date_end . '</p>
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
    
    public static function generateTallas($tallas) {
        $tallasHTML = '';
        foreach ($tallas as $talla) {
            $tallasHTML .= '<button class="btn-talla">EU ' . $talla . ' </button>';
        }
        
        return $tallasHTML;
    }
    
    public static function getNewModelCode($name, $brand) {
        $modelo = new ProductModel();
        $objeto = new Product(null);
        $objeto->__set("name", $name);
        $objeto->__set("brand", $brand);
        $producto = $modelo->readForNameBrand($objeto);
        if (count($producto) > 0) {
            return $producto[0]->modelCode;
        } else {
            $productosAll = $modelo->read();
            $modelCode = 0;
            foreach ($productosAll as $fila) {
                $modelCode = ($modelCode < $fila->modelCode) ? $fila->modelCode : $modelCode;
            }
            return $modelCode + 1;
        }
    }

    public static function replaceSpaceForHyphen($string) {
        return str_replace(' ','-', $string);
    }
    
    public static function replaceHyphenForSpace($string) {
        return str_replace('-',' ', $string);
    }
    
}