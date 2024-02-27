<?php

class CistellaController extends Controller {
    
    public static function show() {
        CistellaView::show();    
    }

    public static function addProduct($id) {

        $prd = new Product($id);
        $productModel = new ProductModel();

        $newProduct = $productModel->getById($prd);

        if(!isset($_SESSION['usuari'])) {

            $carrito = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
            
            if ($newProduct) {
                $carrito[] = $newProduct;
                setcookie('cistella', json_encode($carrito), time() + 86400);
            }

        } else {
            $carretoModel = new CistellaListModel();
            $carretoModel->create($newProduct);
        }

        $cistella = new ProducteController();
        $cistella->mostrarProducte($id);

    }

    public static function cargarProductos() {

        if(isset($_SESSION['usuari'])) {
            $carretoModel = new CistellaListModel();
            $carreto = $carretoModel->read(new Client($_SESSION['usuari']->id));
            $productModel = new ProductModel();
            $productes = $productModel->getAll();
            $productesCarreto = [];

            foreach ($productes as $producte) {
                if ($carreto->hasProduct($producte)) {
                    $productesCarreto[] = $producte;
                }
            }

            return $productesCarreto;
        } else {
            $carrito = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
            return $carrito;
        }

    }

}

