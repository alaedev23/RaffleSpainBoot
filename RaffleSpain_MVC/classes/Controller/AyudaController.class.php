<?php

class AyudaController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    /* Metodo para mostrar la View de Ayuda */
    public function showView() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        AyudaView::showLogin($lang);
    }
    
}