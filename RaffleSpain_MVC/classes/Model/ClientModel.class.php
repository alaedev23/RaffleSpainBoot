<?php

class ClientModel implements Crudable {
    
    public function read($obj = null) {
        
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM Client");
        
        $client = [];
        
        foreach ($resultado as $fila) {
            $clientObj = new Client(null, null, null, null, null, null, null, null, null, null, null);
            $clientObj->__set("id", $fila['id']);
            $clientObj->__set("name", $fila['name']);
            $clientObj->__set("password", $fila['password']);
            $clientObj->__set("surnames", $fila['surnames']);
            $clientObj->__set("born", $fila['born']);
            $clientObj->__set("email", $fila['email']);
            $clientObj->__set("phone", $fila['phone']);
            $clientObj->__set("poblation", $fila['poblation']);
            $clientObj->__set("address", $fila['address']);
            $clientObj->__set("type", $fila['type']);
            $client[] = $clientObj;
        }
        
        return $client;
        
    }
    
    public function create($obj) {
        
        $database = new DataBase('insert');
        
        $params = [$obj->__get("name"), $obj->__get("password"), $obj->__get("surnames"), $obj->__get("born"), $obj->__get("email"), $obj->__get("phone"), $obj->__get("sex"), $obj->__get("poblation"), $obj->__get("address"), $obj->__get("type")];
        
        $resultado = $database->executarSQL("INSERT INTO client (name, password, surnames, born, email, phone, sex, poblation, address, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $params);
        
        return $resultado;
        
    }
    
    public function update($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->__get("name"), $obj->__get("password"), $obj->__get("surnames"), $obj->__get("born"), $obj->__get("email"), $obj->__get("phone"), $obj->__get("sex"), $obj->__get("poblation"), $obj->__get("address"), $obj->__get("type"), $obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE tbl_usuaris SET email = ?, password = ?, tipusIdent = ?, numeroIdent = ?, nom = ?, cognoms = ?, sexe = ?, naixement = ?, adreca = ?, codiPostal = ?, poblacio = ?, provincia = ?, telefon = ?, imatge = ?, status = ? WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function updateToAdmin($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE tbl_usuaris SET type = 1 WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function updateToClient($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE tbl_usuaris SET type = 0 WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function delete($obj) {
        
        $database = new DataBase('delete');
        
        $resultado = $database->executarSQL("DELETE FROM tbl_usuaris WHERE id = ?", [$obj->__get("id")]);
        
        return $resultado;
        
    }
    
    public function getById($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client WHERE email = ? and password = ?", [$obj->__get("email"), $obj->__get("password")]);        
        if (count($resultado) > 0) {
            $fila = $resultado[0];
            $clientObj = new Client(null, null, null, null, null, null, null, null, null, null, null);
            $clientObj->__set("id", $fila['id']);
            $clientObj->__set("name", $fila['name']);
            $clientObj->__set("password", $fila['password']);
            $clientObj->__set("surnames", $fila['surnames']);
            $clientObj->__set("born", $fila['born']);
            $clientObj->__set("email", $fila['email']);
            $clientObj->__set("phone", $fila['phone']);
            $clientObj->__set("poblation", $fila['poblation']);
            $clientObj->__set("address", $fila['address']);
            $clientObj->__set("type", $fila['type']);
            return $clientObj;
        } else {
            return "El email o la contrasenya no son correctos.";
        }
    }
   
}