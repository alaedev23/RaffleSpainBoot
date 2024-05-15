<?php

class DeliverView extends View {

    public function __construct() {
        parent::__construct();
    }

    public static function mostrarPedidos($delivers = null, $errors = '') {
        $html = '<div class="cistella">';
        $html .= '<h1>Mis Vambas Pedidas</h1>';
        $html .= ($errors !== null) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : '';
        $html .= '<ul class="cistella-list">';
        
        if (isset($delivers) && !empty($delivers)) {
            foreach ($delivers as $deliver) {
                $html .= self::renderizarProductoEnCesta($deliver);
            }
        } else {
            $html .= '<p class="emptycistella">No hay pedidos</p>';
        }
        
        $html .= '</ul></div>';
        
        return $html;
    }
    
    private static function renderizarProductoEnCesta($deliver) {
        
        $html = '<li class="product">';
        $html .= '<img src="public/img/vambas/' . $deliver->product->img . '" alt="' . $deliver->product->name . '">';
        $html .= '<div class="product-info">';
        $html .= '<h3>' . Functions::replaceHyphenForSpace($deliver->product->brand) . " " . Functions::replaceHyphenForSpace($deliver->product->name) . '</h3>';
        $html .= '<div class="tallas"><p>' . $deliver->product->size . '</p> </div>';
        $html .= '<p class="precio">' . $deliver->product->price . ' €</p>';
        $html .= '<p> Quantitat: ' . $deliver->quantity . '</p>';   
        $html .= '<p> Fecha de compra: ' . $deliver->date . '</p>';
        $html .= '<a style="margin-top: 10px;" class="btn" href="?mpdf/show/' . $deliver->id . '">Ver Factura</a>';
        $html .= '</div></li>';
        
        return $html;
    }
    
    public static function show($delivers = null, $errors = '') {
        
        $template = self::mostrarPedidos($delivers, $errors);
        
        echo '<!DOCTYPE html><html class="light" lang="es">';
        include "templates/Head.tmp.php";
        echo '<body id="producto_page">';
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/Deliver.tmp.php";
        echo '</main>';
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

}