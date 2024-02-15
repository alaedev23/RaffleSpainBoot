<?php

class RaffleView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function show($rifa, $lang, $errors = null) {
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Rifa.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }

}