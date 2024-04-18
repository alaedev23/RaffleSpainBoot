<?php

class CistellaView extends View {
    
    public static function mostrarCesta($carretoProducts = null) {
        $html = '<div class="cistella">';
        $html .= '<h1>Mi Cesta</h1>';
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
        
        $htmlSizes = Functions::generateFullTallas($sizes);
        
        $html = '<li class="product">';
        $html .= '<img src="public/img/vambas/' . $carretoProduct->product->img . '" alt="' . $carretoProduct->product->name . '">';
        $html .= '<div class="product-info">';
        $html .= '<h3>' . $carretoProduct->product->name . '</h3>';
        $html .= '<p>' . $carretoProduct->product->description . '</p>';
        $html .= '<div class="tallas"><p>' . $carretoProduct->product->size . '</p>' . $htmlSizes . ' </div>';
        $html .= '<p class="precio">' . $carretoProduct->product->price . ' €</p>';
        $html .= '<input type="number" id="cantidad-' . $carretoProduct->product->id . '" value="' . $carretoProduct->quantity . '">';
        $html .= '<div class="btnContainers"><a href="#" onclick="guardarCantidad(' . $carretoProduct->product->id . ')" class="btn">Guardar Cantidad</a>';
        $html .= '<a href="?Cistella/removeProductById/' . $carretoProduct->product->id . '" class="btn">Quitar Cesta</a></div>';
        $html .= '</div></li>';
        
        return $html;
    }
    
    private static function renderizarPrecioTotal($total) {
        $html = '<div class="precio-total">';
        $html .= '<p>Total: ' . number_format($total, 2) . ' €</p>';
        $html .= '<a href="?Cistella/emptyCart" class="btn btnZapatillas">Vaciar carrito</a>';
        $html .= '<button class="btn btnZapatillas">Tramitar Pago</button>';
        $html .= '</div>';
        
        return $html;
    }
    
    public static function show($carretoProducts = null) {
        
        $template = self::mostrarCesta($carretoProducts);
        
        $html = '<!DOCTYPE html><html lang="es">';
        $html .= include "templates/Head.tmp.php";
        $html .= '<body id="producto_page">';
        $html .= include "templates/Header.tmp.php";
        $html .= '<main>';
        $html .= include "templates/Cistella.tmp.php";
        $html .= '</main>';
        $html .= include "templates/Footer.tmp.php";
        $html .= "</body></html>";
        
        return $html;
    }
    
}
