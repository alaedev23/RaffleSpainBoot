<?php

class CarretoListModel implements Crudable {

public function read($obj = null) {
    $database = new DataBase('select');
    $resultado = $database->executarSQL("SELECT * FROM Carreto");

    $carretos = [];

    foreach ($resultado as $fila) {
        $carretoObj = new Carreto($fila['Client_Id'], $fila['Product_Id']);
        $carretos[] = $carretoObj;
    }

    return $carretos;
}

public function create($obj) {
    $database = new DataBase('insert');

    $params = [$obj->getClientId(), $obj->getProductId()];
    
    $resultado = $database->executarSQL("INSERT INTO Carreto (Client_Id, Product_Id) VALUES (?, ?)", $params);

    return $resultado;
}

public function update($obj) {}
public function delete($obj) {}

}
