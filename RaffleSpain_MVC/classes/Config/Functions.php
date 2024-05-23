<?php
use RdKafka\Producer;

/**
 * Clase que contiene diversas funciones útiles.
 */
class Functions
{
    /**
     * Calcula el precio descontado de un producto.
     *
     * @param float $price Precio del producto.
     * @param float $discount Descuento aplicado al producto en porcentaje.
     * @return float Precio descontado.
     */
    public static function discountPrice($price, $discount)
    {
        $discountedPrice = $price - ($price * ($discount / 100));
        return $discountedPrice;
    }
    
    /**
     * Genera la tarjeta de producto para un conjunto de productos.
     *
     * @param array $products Arreglo de productos.
     * @return string Tarjeta de productos en formato HTML.
     */
    public static function generatecardProduct($products)
    {
        $result = '';
        foreach ($products as $product) {
            $result .= '
            <div class="zapatilla">
                <a href="?Producte/mostrarProducte/' . $product->id . ' ">
                    <img src="public/img/vambas/' . $product->img . '" alt="' . self::replaceHyphenForSpace($product->name) . '">
                    <p class="nombre_zapatilla">' . self::replaceHyphenForSpace($product->brand) . ' ' . str_replace('-', ' ', $product->name) . '</p>
                    <p class="sexo_zapatilla">' . self::generateSex($product->sex) . '</p>';
                    if ($product->price != Functions::discountPrice($product->price, $product->discount)) {
                        $result .= '<p class="precio"><span class="beforeDiscount">' . $product->normalPrice . '</span> ' . $product->price . ' €</p>';
                    } else {
                        $result .= '<p class="precio">' . $product->price . ' €</p>';
                    }
                    $result .= '</a></div>';
        }
        return $result;
    }

    /**
     * Genera tarjetas de rifas.
     *
     * @param array|null $rifas Array de objetos de rifas o null si no hay rifas.
     * @return string HTML que representa las tarjetas de rifas.
     */
    public static function generatecardRaffle($rifas)
    {        
        $result = '';
        
        if ($rifas !== null) {
            if (count((array)$rifas) > 0) {
                foreach ($rifas as $rifa) {
                    if ($_SESSION['usuari']->type == 2 || $_SESSION['usuari']->type == 3 || $_SESSION['usuari']->type == 1) {
                        $result .= '
                            <div class="zapatilla">
                                <a href="?Raffle/showRaffleWithId/' . $rifa->id . ' ">
                                    <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . self::replaceHyphenForSpace($rifa->product_id) . '">
                                    <p class="nombre_zapatilla">' . self::replaceHyphenForSpace($rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                                    <p class="date">' . "Participa hasta el " . $rifa->date_end . '</p>
                                </a>
                            </div>';
                    } else {
                        if ($rifa->type == 0) {
                            $result .= '
                                <div class="zapatilla">
                                    <a href="?Raffle/showRaffleWithId/' . $rifa->id . ' ">
                                        <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . self::replaceHyphenForSpace($rifa->product_id) . '">
                                        <p class="nombre_zapatilla">' . self::replaceHyphenForSpace($rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                                        <p class="date">' . "Participa hasta el " . $rifa->date_end . '</p>
                                    </a>
                                </div>';
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Genera tarjetas de rifas para miembros con participación abierta.
     *
     * @param object $rifa Objeto de la rifa.
     * @return string HTML que representa la tarjeta de la rifa.
     */
    public static function generatecardRaffleMemberOpen($rifa)
    {
        $result = '';
        $result .= '
        <div class="zapatilla">
            <a href="?Raffle/showRaffleWithId/' . $rifa->id . ' ">
                <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . self::replaceHyphenForSpace($rifa->product_id) . '">
                <p class="nombre_zapatilla">
                <svg class="iconoRaffleMiembro" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                  <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2M3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/>
                </svg>
                ' . self::replaceHyphenForSpace($rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                <p class="date">' . "Participa hasta el " . $rifa->date_end . '</p>
            </a>
        </div>';

        return $result;
    }

    /**
     * Genera tarjetas de rifas para miembros con participación cerrada.
     *
     * @param object $rifa Objeto de la rifa.
     * @return string HTML que representa la tarjeta de la rifa.
     */
    public static function generatecardRaffleMemberClose($rifa)
    {
        $result = '';
        $result .= '
        <div class="zapatilla">
            <a href="?Raffle/showRaffleWithId/' . $rifa->id . ' ">
                <img src="public/img/vambas/' . $rifa->product->img . '" alt="' . self::replaceHyphenForSpace($rifa->product_id) . '">
                <p class="nombre_zapatilla">
                <svg class="iconoRaffleMiembro" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                </svg>
                ' . self::replaceHyphenForSpace($rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</p>
                <p class="date">' . "Participa hasta el " . $rifa->date_end . '</p>
            </a>
        </div>';

        return $result;
    }

    /**
     * Genera tarjetas de comentarios.
     *
     * @param array $comments Array de objetos de comentarios.
     * @return string HTML que representa las tarjetas de comentarios.
     */
    public static function generateCardComment($comments)
    {
        $result = '';
        foreach ($comments as $comment) {

            $result .= '
                <div class="comment">
                    <div class="comment-card">
                        <h2>' . $comment->__get("title") . '</h2>
                        <p>' . $comment->__get("date") . '</p> <div class="stars">' . self::generateStars($comment->__get("value")) . '</div>
                        <p>' . $comment->__get("comment") . '</p>
                    </div>
                </div>';
        }

        return $result;
    }

    /**
     * Genera estrellas para la calificación.
     *
     * @param int $quantity Cantidad de estrellas a generar.
     * @return string HTML que representa las estrellas de calificación.
     */
    public static function generateStars($quantity)
    {
        $result = '';
        for ($i = 0; $i < $quantity; $i ++) {
            $result .= '
                <img class="star" src="public/img/estrella.png" alt="Estrella"/>
            ';
        }

        $missingStar = 5 - $quantity;
        if ($missingStar !== 0) {
            for ($i = 0; $i < $missingStar; $i ++) {
                $result .= '
                    <img class="star" src="public/img/estrella_vacia.png" alt="Estrella"/>
                ';
            }
        }

        return $result;
    }

    /**
     * Genera el texto correspondiente al sexo del producto.
     *
     * @param string $sex Sexo del producto ('H' para hombre, 'M' para mujer, 'N' para niño).
     * @return string Texto representativo del sexo.
     */
    public static function generateSex($sex)
    {
        if ($sex == 'H') {
            return 'Hombre';
        } else if ($sex == 'M') {
            return 'Mujer';
        } else {
            return 'Niño';
        }
    }

    /**
     * Genera opciones de tallas como radio buttons.
     *
     * @param array $tallas Array de tallas disponibles.
     * @return string HTML que representa las opciones de tallas.
     */
    public static function generateTallas($tallas)
    {
        $tallasHTML = '';
        foreach ($tallas as $talla) {
            $tallasHTML .= '
            <input type="radio" id="talla_' . $talla . '" name="talla" value="' . $talla . '">
            <label for="talla_' . $talla . '">EU ' . $talla . '</label><br>
        ';
        }

        return $tallasHTML;
    }

    /**
     * Genera opciones de tallas como un select.
     *
     * @param array $tallas Array de tallas disponibles.
     * @param string|null $actualTalla Talla actual seleccionada (opcional).
     * @return string HTML que representa las opciones de tallas como un select.
     */
    public static function generateFullTallas($tallas, $actualTalla = null)
    {
        $tallasHTML = '<section>';
        $tallasHTML .= '<select name="talla" id="talla">';
        foreach ($tallas as $talla) {
            if ($actualTalla == $talla) {
                $tallasHTML .= '<option value="' . $talla . '" selected>EU ' . $talla . '</option>';
            } else {
                $tallasHTML .= '<option value="' . $talla . '">EU ' . $talla . '</option>';
            }
        }
        $tallasHTML .= '</select>';
        $tallasHTML .= '</section>';

        return $tallasHTML;
    }

    /**
     * Obtiene un nuevo código de modelo para un producto.
     *
     * @param string $name Nombre del producto.
     * @param string $brand Marca del producto.
     * @return int Nuevo código de modelo para el producto.
     */
    public static function getNewModelCode($name, $brand)
    {
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

    /**
     * Reemplaza los espacios en una cadena por guiones.
     *
     * @param string $string Cadena en la que se reemplazarán los espacios.
     * @return string Cadena con los espacios reemplazados por guiones.
     */
    public static function replaceSpaceForHyphen($string)
    {
        return str_replace(' ', '-', $string);
    }

    /**
     * Reemplaza los guiones en una cadena por espacios.
     *
     * @param string $string Cadena en la que se reemplazarán los guiones.
     * @return string Cadena con los guiones reemplazados por espacios.
     */
    public static function replaceHyphenForSpace($string)
    {
        return str_replace('-', ' ', $string);
    }
    
}