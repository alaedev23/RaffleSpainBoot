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
    
    public static function redimensionarImagen($rutaImagen) {
        // Obtener las dimensiones de la imagen original
        list($ancho_orig, $alto_orig) = getimagesize($rutaImagen);
        
        // Nuevas dimensiones para la imagen redimensionada
        $nuevo_ancho = 600;
        $nuevo_alto = 600;
        
        // Crear una imagen en blanco con las nuevas dimensiones
        $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        
        // Dependiendo del tipo de archivo, carga la imagen original
        $extension = strtolower(pathinfo($rutaImagen, PATHINFO_EXTENSION));
        switch($extension) {
            case 'png':
                $imagen_original = imagecreatefrompng($rutaImagen);
                break;
            case 'jpg':
            case 'jpeg':
                $imagen_original = imagecreatefromjpeg($rutaImagen);
                break;
                // Agrega más casos si necesitas manejar otros tipos de archivos
            default:
                return false; // Devuelve falso si el tipo de archivo no es compatible
        }
        
        // Redimensionar la imagen original a la nueva imagen
        imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_orig, $alto_orig);
        
        // Guardar la imagen redimensionada en la misma ruta de destino
        switch($extension) {
            case 'png':
                imagepng($imagen_redimensionada, $rutaImagen);
                break;
            case 'jpg':
            case 'jpeg':
                imagejpeg($imagen_redimensionada, $rutaImagen);
                break;
                // Agrega más casos si necesitas manejar otros tipos de archivos
        }
        
        // Liberar la memoria ocupada por las imágenes
        imagedestroy($imagen_original);
        imagedestroy($imagen_redimensionada);
        
        return true; // Devuelve verdadero si la redimensión fue exitosa
    }

    public static function replaceSpaceForHyphen($string) {
        return str_replace(' ','-', $string);
    }
    
    public static function replaceHyphenForSpace($string) {
        return str_replace('-',' ', $string);
    }
    
}