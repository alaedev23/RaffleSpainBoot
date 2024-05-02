<?php

class ContactView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function show($lang, $errors = '') {
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/ContactUs.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}