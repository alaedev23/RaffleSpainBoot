<?php
class ErrorView extends View {

    public function __construct() {
        parent::__construct();
    }
    public function show(Exception $e) {
        $fitxerDeTraduccions = "lang/{$this->lang}.php";
        include $fitxerDeTraduccions;
        
        $titol = "hi ha hagut un error";
        $missatge = $e->getMessage();
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        //include "templates/head.php";
        echo "<body>";
	    //include "templates/header.php";
		include "templates/Error_tmp.php";
		echo "</body></html>";
    }
}

