<?php

class FavoritosListModel {

    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM favoritos where client_id = ?", [$obj->client_id]);

        $favoritosObj = new FavoritosList();
        $productModel = new ProductModel();

        foreach ($resultado as $fila) {
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $favoritosObj->addProduct($product);
        }

        $favoritosObj->client_id = $obj->client_id;

        return $favoritosObj;
    }

    public function getFavoritoByIds($client_id, $product_id) {
        $database = new DataBase('select');
        $params = [$client_id, $product_id];
        $resultado = $database->executarSQL("SELECT * FROM favoritos WHERE client_id = ? AND product_id = ?", $params);

        if (count($resultado) > 0) {
            $favoritosObj = new FavoritosList();
            $productModel = new ProductModel();

            foreach ($resultado as $fila) {
                $product = new Product($fila["product_id"]);
                $product = $productModel->getById($product);
                $favoritosObj->addProduct($product);
            }

            $favoritosObj->client_id = $client_id;

            return $favoritosObj;
        } else {
            return null;
        }
    }

public function create($obj) {
    $database = new DataBase('insert');

    $params = [$obj->client_id, $obj->product_id];
    
    $resultado = $database->executarSQL("INSERT INTO favoritos (client_id, product_id) VALUES (?, ?)", $params);

    return $resultado;
}

public function update($obj) {}
public function delete($obj) {
    $database = new DataBase('delete');

    $params = [$obj->id];

    $resultado = $database->executarSQL("DELETE FROM favoritos WHERE product_id = ?", $params);

    return $resultado;
}

}