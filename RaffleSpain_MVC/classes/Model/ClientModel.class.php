<?php

class ClientModel implements Crudable {
    
    public function read($obj = null) {
        
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client");
        
        $client = [];
        
        foreach ($resultado as $fila) {
            $clientObj = $this->createClientFromData($fila);
            $client[] = $clientObj;
        }
        
        return $client;
        
    }
    
    public function create($obj) {
        
        $database = new DataBase('insert');
                
        $resultado = [];
        
        if (strlen($obj->__get("born")) > 0) {
            $params = [$obj->__get("name"), $obj->__get("password"), $obj->__get("surnames"), $obj->__get("born"), $obj->__get("email"), $obj->__get("phone"), $obj->__get("sex"), $obj->__get("poblation"), $obj->__get("address"), $obj->__get("type")];
            $resultado = $database->executarSQL("INSERT INTO client (name, password, surnames, born, email, phone, sex, poblation, address, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $params);
        } else {
            $params = [$obj->__get("name"), $obj->__get("password"), $obj->__get("surnames"), $obj->__get("email"), $obj->__get("phone"), $obj->__get("sex"), $obj->__get("poblation"), $obj->__get("address"), $obj->__get("type")];
            $resultado = $database->executarSQL("INSERT INTO client (name, password, surnames, email, phone, sex, poblation, address, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $params);
        }
                
        return $resultado;
        
    }
    
    public function update($obj) {
        $database = new DataBase('update');
              
        $params = [
            $obj->__get("name"),
            $obj->__get("email"),
            $obj->__get("password"),
            $obj->__get("surnames"),
            $obj->__get("born"),
            $obj->__get("phone"),
            $obj->__get("poblation"),
            $obj->__get("address"),
            $obj->__get("sex"),
            $obj->__get("type"),
            $obj->__get("id")
        ];
        
        $resultado = $database->executarSQL("UPDATE client SET name = ?, email = ?, password = ?, surnames = ?, born = ?, phone = ?, poblation = ?, address = ?, sex = ?, type = ? WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function updatePassword($obj) {
        $database = new DataBase('update');
        
        $params = [$obj->__get("password"), $obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE client SET password = ? WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function updateToAdmin($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE client SET type = 2 WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function updateToClient($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE client SET type = 0 WHERE id = ?", $params);
        
        return $resultado;
    }

    public function validateType($obj) {
        $database = new DataBase('update');
        
        $params = [$obj->__get("id")];
        
        $resultado = $database->executarSQL("UPDATE client SET type = 1 WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function delete($obj) {
        
        $database = new DataBase('delete');
        
        $resultado = $database->executarSQL("DELETE FROM client WHERE id = ?", [$obj->__get("id")]);
        
        return $resultado;
        
    }
    
    public function getByEmailPassword($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client WHERE email = ? and password = ?", [$obj->__get("email"), $obj->__get("password")]);
        if (count($resultado) > 0) {
            $clientObj = $this->createClientFromData($resultado[0]);
            return $clientObj;
        } else {
            return "El email o la contrasenya no son correctos.";
        }
    }
    
    public function getById($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client WHERE id = ?", [$obj->__get("id")]);  
        if (count($resultado) > 0) {
            $clientObj = $this->createClientFromData($resultado[0]);
            return $clientObj;
        } else {
            return "No se ha encontrado usuario en el GetById.";
        }
    }

    public function getByEmail($email) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client WHERE email = ?", [$email]);
        if (count($resultado) > 0) {
            $clientObj = $this->createClientFromData($resultado[0]);
            return $clientObj;
        } else {
            return "No se ha encontrado usuario en el GetByEmail.";
        }
    }

    public function getByPhone($phone) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM client WHERE phone = ?", [$phone]);
        if (count($resultado) > 0) {
            $clientObj = $this->createClientFromData($resultado[0]);
            return $clientObj;
        } else {
            return false;
        }
    }

    public function updateStatus($obj) {
        $database = new DataBase('update');
        
        $params = [1,$obj->id];
        
        $resultado = $database->executarSQL("UPDATE client SET status = ? WHERE id = ?", $params);
        
        return $resultado;
    }
    
    private function createClientFromData($data)
    {
        return new Client (
            $data['id'],
            $data['name'],
            $data['password'],
            $data['surnames'],
            $data['born'],
            $data['email'],
            $data['phone'],
            $data['sex'],
            $data['poblation'],
            $data['address'],
            $data['type']
        );
    }
   
}