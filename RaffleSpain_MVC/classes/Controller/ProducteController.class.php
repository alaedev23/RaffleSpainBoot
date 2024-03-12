<?php

class ProducteController extends Controller {

    protected $product;

    public function mostrarProducte($id) {

        $mProducts = new ProductModel();
        $productId = new Product($id[0]);

        $this->product = $mProducts->getById($productId);
        $tallas = $mProducts->getTallas($this->product);

        $enFavoritos = null;

        if (isset($_SESSION['usuari'])) {
            $favoritosModel = new FavoritosListModel();
            $enFavoritos = $favoritosModel->getFavoritoByIds($_SESSION['usuari']->id, $id);
        }

        $vProducte = new ProducteView();
        $vProducte->show($this->product, $tallas, $enFavoritos);

    }

}
