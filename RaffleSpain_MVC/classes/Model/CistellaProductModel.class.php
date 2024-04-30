<?php

class CistellaProductModel {

    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM carreto where client_id = ?", [$obj->client_id]);

        $productModel = new ProductModel();
        $carretoArray = [];

        foreach ($resultado as $fila) {
            $carretoObj = new CistellaProduct();
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            $carretoObj->quantity = $fila["quantity"];
            $carretoObj->size = $fila["talla"];
            $carretoArray[] = $carretoObj;
        }

        return $carretoArray;
    }

    public function readByClientAndProduct($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM carreto where client_id = ? AND product_id = ?", [$obj->client_id, $obj->product->id]);

        $productModel = new ProductModel();

        if (!empty($resultado)) {
            $carretoObj = new CistellaProduct();
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

        $params = [$obj->client_id, $obj->product->id, $obj->size];

        $resultado = $database->executarSQL("INSERT INTO carreto (client_id, product_id, talla) VALUES (?, ?, ?)", $params);
        return $resultado;
    }

    public function update($obj) {
        $database = new DataBase('update');

        $params = [$obj->quantity, $obj->client_id, $obj->product->id, $obj->size];

        $resultado = $database->executarSQL("UPDATE carreto SET quantity = ? WHERE client_id = ? AND product_id = ? AND talla = ?", $params);

        return $resultado;
    }

    public function updateQuantityAndSize($obj) {
        $database = new DataBase('update');

        $params = [$obj->quantity, $obj->size, $obj->client_id, $obj->product->id, $obj->size];

        $resultado = $database->executarSQL("UPDATE carreto SET quantity = ?, size = ? WHERE client_id = ? AND product_id = ? AND talla = ?", $params);

        return $resultado;
    }
    
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
