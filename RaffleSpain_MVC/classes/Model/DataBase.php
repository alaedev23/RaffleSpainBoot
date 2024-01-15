<?php

class DataBase {
    
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
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function getConexion()
    {
        return $this->conexion;
    }
    
}

?>