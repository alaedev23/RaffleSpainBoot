<?php

class ProducteView extends View {
    public function show($producte, $tallas) {

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        include "templates/Producte.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";

    }

}
