<?php


/**
 * Class ClientModel
 *
 * Esta clase maneja las operaciones CRUD para la entidad Client.
 */
class ClientModel implements Crudable {
    
    /**
     * Lee todos los clientes de la base de datos.
     *
     * @param mixed $obj (opcional) No se utiliza en este método.
     * @return array Un array de objetos Client.
     */
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
    
    /**
     * Crea un nuevo cliente en la base de datos.
     *
     * @param Client $obj El objeto Client a crear.
     * @return mixed El resultado de la operación de inserción.
     */
    public function create($obj) {
        $database = new DataBase('insert');
        $params = [
            $obj->__get("name"),
            $obj->__get("password"),
            $obj->__get("surnames"),
            $obj->__get("email"),
            $obj->__get("phone"),
            $obj->__get("sex"),
            $obj->__get("poblation"),
            $obj->__get("address"),
            $obj->__get("type")
        ];
        $resultado = $database->executarSQL("INSERT INTO client (name, password, surnames, email, phone, sex, poblation, address, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", $params);
        
        $arrayUpdate = [
            "born" => $obj->__get("born"),
            "floor" => $obj->__get("floor"),
            "door" => $obj->__get("door"),
            "postal_code" => $obj->__get("postal_code")
        ];
        $databaseUpdate = new DataBase('update');
        $newId = $this->getByEmail($obj->__get("email"));
        $obj->__set("id", $newId->__get("id"));
        foreach ($arrayUpdate as $selected => $value) {
            if ($obj->__get($selected) !== null) {
                $params = [$obj->__get($selected), $obj->__get("id")];
                $resultado = $databaseUpdate->executarSQL("UPDATE client SET " . $selected . " = ? WHERE id = ?", $params);
            }
        }
        return $resultado;
    }
    
    /**
     * Actualiza un cliente existente en la base de datos.
     *
     * @param Client $obj El objeto Client a actualizar.
     * @return mixed El resultado de la operación de actualización.
     */
    public function update($obj) {
        $database = new DataBase('update');
        if ($obj->__get("email") !== $_SESSION['usuari']->email) {
            $database->executarSQL("UPDATE client SET email = ? WHERE id = ?", [$obj->__get("email"), $obj->__get("id")]);
        }
        if ($obj->__get("phone") !== $_SESSION['usuari']->phone) {
            $database->executarSQL("UPDATE client SET phone = ? WHERE id = ?", [$obj->__get("phone"), $obj->__get("id")]);
        }
        $params = [
            $obj->__get("name"),
            $obj->__get("password"),
            $obj->__get("surnames"),
            $obj->__get("born"),
            $obj->__get("poblation"),
            $obj->__get("address"),
            $obj->__get("sex"),
            $obj->__get("type"),
            $obj->__get("floor"),
            $obj->__get("door"),
            $obj->__get("postal_code"),
            $obj->__get("id")
        ];
        $resultado = $database->executarSQL("UPDATE client SET name = ?, password = ?, surnames = ?, born = ?, poblation = ?, address = ?, sex = ?, type = ?, floor = ?, door = ?, postal_code = ? WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Actualiza la dirección de un cliente.
     *
     * @param Client $obj El objeto Client con la nueva dirección.
     * @return mixed El resultado de la operación de actualización.
     */
    public function updateDirection($obj) {
        $database = new DataBase('update');
        $params = [
            $obj->__get("address"),
            $obj->__get("poblation"),
            $obj->__get("floor"),
            $obj->__get("door"),
            $obj->__get("postal_code"),
            $obj->__get("id")
        ];
        $resultado = $database->executarSQL("UPDATE client SET address = ?, poblation = ?, floor = ?, door = ?, postal_code = ? WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Actualiza la contraseña de un cliente.
     *
     * @param Client $obj El objeto Client con la nueva contraseña.
     * @return mixed El resultado de la operación de actualización.
     */
    public function updatePassword($obj) {
        $database = new DataBase('update');
        $params = [$obj->__get("password"), $obj->__get("id")];
        $resultado = $database->executarSQL("UPDATE client SET password = ? WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Convierte un cliente en administrador.
     *
     * @param Client $obj El objeto Client a convertir en administrador.
     * @return mixed El resultado de la operación de actualización.
     */
    public function updateToAdmin($obj) {
        $database = new DataBase('update');
        $params = [$obj->__get("id")];
        $resultado = $database->executarSQL("UPDATE client SET type = 2 WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Convierte un administrador en cliente.
     *
     * @param Client $obj El objeto Client a convertir en cliente.
     * @return mixed El resultado de la operación de actualización.
     */
    public function updateToClient($obj) {
        $database = new DataBase('update');
        $params = [$obj->__get("id")];
        $resultado = $database->executarSQL("UPDATE client SET type = 0 WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Valida el tipo de un cliente.
     *
     * @param Client $obj El objeto Client a validar.
     * @return mixed El resultado de la operación de validación.
     */
    public function validateType($obj) {
        $database = new DataBase('update');
        $params = [$obj->__get("id")];
        $resultado = $database->executarSQL("UPDATE client SET type = 1 WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Elimina un cliente de la base de datos.
     *
     * @param Client $obj El objeto Client a eliminar.
     * @return mixed El resultado de la operación de eliminación.
     */
    public function delete($obj) {
        $database = new DataBase('delete');
        $resultado = $database->executarSQL("DELETE FROM client WHERE id = ?", [$obj->__get("id")]);
        return $resultado;
    }
    
    /**
     * Obtiene un cliente por su email y contraseña.
     *
     * @param Client $obj El objeto Client con el email y contraseña.
     * @return Client|string El objeto Client si se encuentra, de lo contrario un mensaje de error.
     */
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
    
    /**
     * Obtiene un cliente por su ID.
     *
     * @param Client $obj El objeto Client con el ID.
     * @return Client|string El objeto Client si se encuentra, de lo contrario un mensaje de error.
     */
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
    
    /**
     * Obtiene un cliente por su número de teléfono.
     *
     * @param string $phone El número de teléfono del cliente.
     * @return Client|bool El objeto Client si se encuentra, de lo contrario false.
     */
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
    
    /**
     * Actualiza el estado de un cliente.
     *
     * @param Client $obj El objeto Client con el estado a actualizar.
     * @return mixed El resultado de la operación de actualización.
     */
    public function updateStatus($obj) {
        $database = new DataBase('update');
        $params = [1, $obj->id];
        $resultado = $database->executarSQL("UPDATE client SET status = ? WHERE id = ?", $params);
        return $resultado;
    }
    
    /**
     * Crea un objeto Client a partir de un array de datos.
     *
     * @param array $data Los datos del cliente.
     * @return Client El objeto Client creado a partir de los datos.
     */
    private function createClientFromData($data) {
        return new Client(
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
            $data['type'],
            $data['floor'],
            $data['door'],
            $data['postal_code']
            );
    }
}