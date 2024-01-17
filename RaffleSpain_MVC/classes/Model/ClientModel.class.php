<?php

class ClientModel implements Crudable {
    
    public function read($obj = null) {
        
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM Client");
        
        $client = [];
        
        foreach ($resultado as $fila) {
            $clientObj = new Client(
                $fila['Id'],
                $fila['Name'],
                $fila['Password'],
                $fila['Surnames'],
                $fila['Lorn'],
                $fila['Email'],
                $fila['Phone']
            );
            $client[] = $clientObj;
        }
        
        return $client;
        
    }
    
    public function create($obj) {
        
        $database = new DataBase('insert');
        
        $obj->plataforma = PHP_OS;
        $obj->navegador = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
        $dateTime = new DateTime();
        $obj->dataCreacio = $dateTime->format("Y-m-d H:i:s");
        $obj->dataDarrerAcces = $obj->dataCreacio;
        
        $params = [$obj->email, $obj->password, $obj->tipusIdent, $obj->numeroIdent, $obj->nom, $obj->cognoms, $obj->sexe, $obj->naixement, $obj->adreca, $obj->codiPostal, $obj->poblacio, $obj->provincia, $obj->telefon, $obj->imatge, $obj->status, $obj->navegador, $obj->plataforma, $obj->dataCreacio, $obj->dataDarrerAcces];
        
        $resultado = $database->executarSQL("INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge, status, navegador, plataforma, dataCreacio, dataDarrerAcces) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $params);
        
        return $resultado;
        
    }
    
    public function update($obj) {
        
        $database = new DataBase('update');
        
        $params = [$obj->email, $obj->password, $obj->tipusIdent, $obj->numeroIdent, $obj->nom, $obj->cognoms, $obj->sexe, $obj->naixement, $obj->adreca, $obj->codiPostal, $obj->poblacio, $obj->provincia, $obj->telefon, $obj->imatge, $obj->status, $obj->id];
        
        $resultado = $database->executarSQL("UPDATE tbl_usuaris SET email = ?, password = ?, tipusIdent = ?, numeroIdent = ?, nom = ?, cognoms = ?, sexe = ?, naixement = ?, adreca = ?, codiPostal = ?, poblacio = ?, provincia = ?, telefon = ?, imatge = ?, status = ? WHERE id = ?", $params);
        
        return $resultado;
    }
    
    public function delete($obj) {
        
        $database = new DataBase('delete');
        
        $resultado = $database->executarSQL("DELETE FROM tbl_usuaris WHERE id = ?", [$obj->id]);
        
        return $resultado;
        
    }
    
    public function getById($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM Client WHERE email = ? and password = ?", [$obj->email, $obj->password]);
        
        if (count($resultado) > 0) {
            var_dump($resultado[0]);
            $fila = $resultado[0];
            $clientObj = new Client(
                $fila['Id'],
                $fila['Name'],
                $fila['Password'],
                $fila['Surnames'],
                $fila['Born'],
                $fila['Email'],
                $fila['Phone']
            );
            return $clientObj;
        } else {
            return throw new Exception("Se ha producido un error en el metodo GetById.");
        }
    }
   
}