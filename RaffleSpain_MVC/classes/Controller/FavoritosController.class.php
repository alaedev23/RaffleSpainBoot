<?php

class FavoritosController extends Controller {
    
    public function cookiesControl() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }

        return $lang;
    }
    public function show() {
        
        $lang = $this->cookiesControl();

        if(!isset($_SESSION['usuari'])) {
            header("Location: index.php?client/formLogin");
        } else {
            $user = $_SESSION['usuari'];
            
            MapView::showMap($lang);
        }

    }
    
}