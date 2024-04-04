<?php

class CistellaView extends View {
    
    public static function show($carretoProducts = null) {
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/Cistella.tmp.php";
        echo '</main>';
        include "templates/Footer.tmp.php";
        echo "</body></html>";

    }

}