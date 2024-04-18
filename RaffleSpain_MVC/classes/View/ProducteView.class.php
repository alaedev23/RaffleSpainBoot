<?php

class ProducteView extends View {

    private $mComment;
    
    public function __construct() {
        $this->mComment = new CommentModel();
    }
    
    public function show($producte, $tallas, $enFavoritos, $errors = '') {
        
        $getComments = $this->mComment->getById($producte);        
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        include "templates/Producte.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";

    }

}
