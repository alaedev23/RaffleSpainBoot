<?php

class CistellaListModel {

    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM carreto where client_id = ?", [$obj->client_id]);

        $carretoObj = new CistellaList();
        $productModel = new ProductModel();

        foreach ($resultado as $fila) {
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->addProduct($product);
        }

        $carretoObj->client_id = $obj->client_id;

        return $carretoObj;
    }

    public function create($obj) {
        $database = new DataBase('insert');

        $params = [$obj->client_id, $obj->carreto[0]->id];

        $resultado = $database->executarSQL("INSERT INTO carreto (client_id, product_id) VALUES (?, ?)", $params);

        return $resultado;
    }

    public function update($obj) {}

    public function deleteByClientId($obj) {
        $database = new DataBase('delete');

        $params = [$obj->id];

        $resultado = $database->executarSQL("DELETE FROM carreto WHERE client_id = ?", $params);

        return $resultado;
    }
    
    public function deleteById($obj) {
        $database = new DataBase('delete');

        $params = [$obj->id];

        $resultado = $database->executarSQL("DELETE FROM carreto WHERE product_id = ?", $params);

        return $resultado;
    }

}
