<?php

class FavoritosView extends View {
    
    public static function show($carretoProducts = null) {
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        include "templates/Favoritos.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";

    }

}