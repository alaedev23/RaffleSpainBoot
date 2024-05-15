<?php

class CistellaView extends View {
    
    public static function mostrarCesta($carretoProducts = null, $errors = '') {
        $html = (count($carretoProducts) === 0) ? '<div style="height: calc(100vh - 480px)" class="cistella">' : '<div class="cistella">';
        $html .= '<h1>Mi Cesta</h1>';
        ($errors !== '') ? $html .= "<div class=\"errorMessage\"><p>$errors</hp></div>" : '';
        $html .= '<ul class="cistella-list">';
        
        $total = 0;
        if (isset($carretoProducts) && !empty($carretoProducts)) {
            foreach ($carretoProducts as $carretoProduct) {
                $total += $carretoProduct->product->price * $carretoProduct->quantity;
                $html .= self::renderizarProductoEnCesta($carretoProduct);
            }
            $html .= self::renderizarPrecioTotal($total);
        } else {
            $html .= '<p class="emptycistella">No hay productos en la cesta</p>';
        }
        
        $html .= '</ul></div>';
        
        return $html;
    }
    
    private static function renderizarProductoEnCesta($carretoProduct) {
        
        $mProduct = new ProductModel();
        $sizes = $mProduct->getTallas($carretoProduct->product);
        
        $htmlSizes = Functions::generateFullTallas($sizes, $carretoProduct->size);
        
        $html = '<li class="product">';
        $html .= '<img src="public/img/vambas/' . $carretoProduct->product->img . '" alt="' . $carretoProduct->product->name . '">';
        $html .= '<div class="product-info">';
        $html .= '<h3>' . Functions::replaceHyphenForSpace($carretoProduct->product->brand) . " " . Functions::replaceHyphenForSpace($carretoProduct->product->name) . '</h3>';
        $html .= '<div class="tallas"><p>' . $carretoProduct->size . '</p>' . $htmlSizes . ' </div>';
        $html .= '<p class="precio">' . $carretoProduct->product->price . ' €</p>';
        $html .= '<input type="number" min="0" id="cantidad-' . $carretoProduct->product->id . '" value="' . $carretoProduct->quantity . '">';
        $html .= '<div class="btnContainer"><a href="#" onclick="guardarCantidadYtalla(' . $carretoProduct->product->id . ')" class="btn">Guardar</a>';
        $html .= '<a href="?Cistella/removeProductById/' . $carretoProduct->product->id . '" class="btn">Quitar Cesta</a></div>';
        $html .= '</div></li>';
        
        return $html;
    }
    
    private static function renderizarPrecioTotal($total) {
        $html = '<div class="precio-total">';
        $html .= '<p>Total: ' . number_format($total, 2) . ' €</p>';
        $html .= '<div class="botones-compra">';
        $html .= '<a href="?Cistella/emptyCart" class="btn btnZapatillas">Vaciar carrito</a>';
        $html .= '<a href="?PayPal/createOrder" class="btn btnZapatillas">Tramitar Pago</a>';
        $html .= '</div></div>';
        
        return $html;
    }
    
    public static function show($carretoProducts = null, $errors = '') {
        
        $template = self::mostrarCesta($carretoProducts, $errors);
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo '<body id="producto_page">';
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/Cistella.tmp.php";
        echo '</main>';
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
        return $html;
    }
    
}
