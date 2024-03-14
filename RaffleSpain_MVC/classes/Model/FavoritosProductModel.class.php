<?php

class FavoritosProductModel {

    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM favoritos where client_id = ?", [$obj->client_id]);

        $productModel = new ProductModel();
        $carretoArray = [];

        foreach ($resultado as $fila) {
            $carretoObj = new FavoritosProduct();
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            $carretoArray[] = $carretoObj;
        }

        return $carretoArray;
    }

    public function readByClientAndProduct($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM favoritos where client_id = ? AND product_id = ?", [$obj->client_id, $obj->product->id]);

        $productModel = new ProductModel();

        if (!empty($resultado)) {
            $carretoObj = new FavoritosProduct();
            $product = new Product($resultado[0]["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            return $carretoObj;
        }

        return null;
    }

    public function create($obj) {
        $database = new DataBase('insert');

        $params = [$obj->client_id, $obj->product->id];

        $resultado = $database->executarSQL("INSERT INTO favoritos (client_id, product_id) VALUES (?, ?)", $params);
        return $resultado;
    }
    
    public function deleteByClientId($obj) {
        $database = new DataBase('delete');

        $params = [$obj->id];

        $resultado = $database->executarSQL("DELETE FROM favoritos WHERE client_id = ?", $params);

        return $resultado;
    }
    
    public function deleteById($obj) {
        $database = new DataBase('delete');

        $params = [$obj->id];

        $resultado = $database->executarSQL("DELETE FROM favoritos WHERE product_id = ?", $params);

        return $resultado;
    }

}
