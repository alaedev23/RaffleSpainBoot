<?php

/**
 * Clase ProductSexView
 *
 * Esta clase se utiliza para mostrar vistas relacionadas con productos según su género.
 */
class ProductSexView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la vista de productos según su género.
     *
     * @param string $lang Idioma de la página.
     * @param string $sexo Género de los productos.
     * @param array $productos Lista de productos.
     * @param mixed $errors Errores (opcional).
     */
    public static function showView($lang, $sexo, $productos, $errors = null) {
        
        $proctos = self::generarProductos($sexo, $productos);
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo $proctos;
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    /**
     * Genera la sección de productos.
     *
     * @param string $sexo Género de los productos.
     * @param array $productos Lista de productos.
     * @param mixed $errors Errores (opcional).
     * @return string HTML de la sección de productos.
     */
    public static function generarProductos($sexo, $productos, $errors = null) {

        $templateProduct = "<section class=\"containerProductos\">";
        $templateProduct .= Functions::generatecardProduct($productos);
        $templateProduct .= "</section>";
        return $templateProduct;
        
    }
    
}