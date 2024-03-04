<?php

class CistellaListModel {

    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM Carreto where Client_id = ?", [$obj->getClientId()]);

        $carretoObj = new CistellaList();

        foreach ($resultado as $fila) {
            $product = new Product($fila["product_id"]);
            $carretoObj->addProduct($product);
        }

        $carretoObj->client_id = $obj->getClientId();

        return $carretoObj;
    }

    public function create($obj) {
        $database = new DataBase('insert');

        $params = [$obj->client_id, $obj->carreto[0]->id];
        
        var_dump($params);

        $resultado = $database->executarSQL("INSERT INTO carreto (Client_Id, Product_Id) VALUES (?, ?)", $params);

        return $resultado;
    }

    public function update($obj) {}
    public function delete($obj) {}

}
