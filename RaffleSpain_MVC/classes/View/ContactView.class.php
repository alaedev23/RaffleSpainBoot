<?php

class ContactView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function show($lang, $send, $errors = '') {
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/ContactUs.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
}
