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
            $favoritosList = new FavoritosList();
            $favoritosModel = new FavoritosListModel();

            $favoritosList->client_id = $_SESSION['usuari']->id;
            $cistella = $favoritosModel->read($favoritosList);

            foreach ($cistella->favoritos as $favoritosProduct) {
                $favoritosArray[] = $favoritosProduct->toArray();
            }

            FavoritosView::show($favoritosArray);
        }

    }
    
}