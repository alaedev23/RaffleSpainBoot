<?php

class CistellaController extends Controller {
    
    public static function show() {

        $productos = self::cargarProductos();

        CistellaView::show($productos);    
    }

    public static function addProduct($id) {

        $prd = new Product($id[0]);
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
            $cistella = $carretoModel->read(new Client($_SESSION['usuari']->id));
            return is_array($cistella) ? $cistella : $cistella->carreto;
        } else {
            $cistella = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
            return $cistella;
        }
    }
    

}

