<?php

class DataBase {
    
    private $conexion;
    
    public function __construct($tipoConsulta) {
        if ($tipoConsulta === 'select' || $tipoConsulta === 'update' || $tipoConsulta === 'delete' || $tipoConsulta === 'insert') {
            $this->conexion = new Connexio($tipoConsulta);
            $dsn = "{$this->conexion->getSgbd()}:host={$this->conexion->getHost()};dbname={$this->conexion->getBase()};charset=utf8";
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            );
            try {
                $this->conexion = new PDO($dsn, $this->conexion->getUsuario(), $this->conexion->getPassword(), $opciones);
            } catch (PDOException $e) {
                throw new Exception("No se ha conectado a la base de datos. " . $e->getMessage());
            }
        } else {
            throw new Exception("La consulta '$tipoConsulta' no es una consulta válida.");
        }
    }
    
    public function executarSQL($sSql, $aParam = null) {
        try {
            $stmt = $this->conexion->prepare($sSql);
            if (!empty($aParam)) {
                $stmt->execute($aParam);
            } else {
                $stmt->execute();
            }

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($res !== false) {
                $resultado = $res;
            } else {
                $resultado = "La consulta se ha realizado con éxito";
            }
        } catch (PDOException $e) {
            $resultado = "Error al ejecutar la consulta: " . $e->getMessage();
        }

        return $resultado;
    }
    
    public function getLastInsertedId()
    {
        return $this->conexion->lastInsertId();
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}



?>

<!-- antigua implementacion de DataBase !! -->

<!-- class DataBase {
    
    private $link;
    private $conexion;
    
    public function __construct($tipoConsulta) {
        if ($tipoConsulta === 'select' || $tipoConsulta === 'update' || $tipoConsulta === 'delete' || $tipoConsulta === 'insert') {
            $this->conexion = new Connexio($tipoConsulta);
            switch ($this->conexion->getSgbd()) {
                case 'mysql' :
                    if ($link = new mysqli($this->conexion->getHost(), $this->conexion->getUsuario(), $this->conexion->getPassword(), $this->conexion->getBase())){
                        $this->link = $link;
                    } else {
                        throw new Exception("No se ha conectado a la base de datos.");
                    }
                    break;
                case 'pgsql' :
                    break;
                case 'oracle' :
                    break;
                case 'mongodb' :
                    break;
            }
        } else {
            throw new Exception("La consulta '$tipoConsulta' no es una consulta buena.");
        }
    }
    
    public function __destruct() {
        $this->link->close();
    }
    
    public function executarSQL($sSql, $aParam = null) {
        if ($stmt = $this->link->prepare($sSql)) {
            if (!empty($aParam)) {
                $types = str_repeat('s', count($aParam));
                $stmt->bind_param($types, ...$aParam);
            }
            if ($stmt->execute()) {
                $res = $stmt->get_result();
                if ($res !== false) {
                    $resultado = $res->fetch_all(MYSQLI_ASSOC);
                } else {
                    $resultado = "La consulta se ha realizado con existo";
                }
            } else {
                $resultado = "Error al ejecutar la consulta: " . $stmt->error;
            }
        }
        else {
            $resultado = "Error en la preparacion";
        }
        return $resultado;
    }
    
    public function getLastInsertedId()
    {
        return $this->link->insert_id;
    }

    public function getLink()
    {
        return $this->link;
    }
    
    public function getConexion()
    {
        return $this->conexion;
    }
    
} -->