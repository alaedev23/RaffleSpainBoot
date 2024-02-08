<?php

class AdminView extends View {
    
    public static function show($lang) {
        
        $result = generateSectionAdmin();
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"producto_page\">";
        include "templates/Header.tmp.php";
        include "templates/Admin.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    public function generateSectionAdmin() {
        
        $html = "<input>";
        
    }
    
}
?>