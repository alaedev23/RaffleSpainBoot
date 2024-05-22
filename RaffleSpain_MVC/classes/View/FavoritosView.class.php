<?php

/**
 * Clase FavoritosView
 *
 * Esta clase se utiliza para mostrar la vista de productos favoritos.
 */
class FavoritosView extends View {
    
    /**
     * Muestra la vista de productos favoritos.
     *
     * @param array|null $carretoProducts Los productos favoritos a mostrar.
     */
    public static function show($carretoProducts = null) {
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        include "templates/Favoritos.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";

    }

}