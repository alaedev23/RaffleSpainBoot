<?php

class MapController extends Controller {
    
    public function mostrar() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        MapView::showMap($lang);
    }
    
}