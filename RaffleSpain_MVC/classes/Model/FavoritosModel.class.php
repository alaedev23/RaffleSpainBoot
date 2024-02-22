<?php

class FavoritosListModel implements Crudable {

public function read($obj = null) {
    $database = new DataBase('select');
    $resultado = $database->executarSQL("SELECT * FROM Favoritos");

    $favoritos = [];

    foreach ($resultado as $fila) {
        $favoritosObj = new Favoritos($fila['Client_Id'], $fila['Product_Id']);
        $favoritos[] = $favoritosObj;
    }

    return $favoritos;
}

public function create($obj) {
    $database = new DataBase('insert');

    $params = [$obj->getClientId(), $obj->getProductId()];
    
    $resultado = $database->executarSQL("INSERT INTO Favoritos (Client_Id, Product_Id) VALUES (?, ?)", $params);

    return $resultado;
}

public function update($obj) {}
public function delete($obj) {}

}
