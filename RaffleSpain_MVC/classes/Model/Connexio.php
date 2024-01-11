<?php

class Connexio {
    
    private $sgbd;
    private $base;
    private $host;
    private $usuario;
    private $password;
    private const DATOSCONEXION = "classes/config/DatosConexion.php";
    
    public function __construct($tipoConsulta) {
        if (file_exists(self::DATOSCONEXION)) {
            include 'classes/config/DatosConexion.php';
            $this->sgbd = $sgbd;
            $this->base = $base;
            $this->host = ini_get('mysqli.default_host');
            if ($tipoConsulta === 'select') {
                $this->usuario = $usuarioSelect;
                $this->password = $passwordSelect;
            } else if ($tipoConsulta === 'update' || $tipoConsulta === 'delete' || $tipoConsulta === 'insert') {
                $this->usuario = ini_get('mysqli.default_user');
                $this->password = ini_get('mysqli.default_pw');
            }
            else {
                throw new Exception("La consulta '$tipoConsulta' no es una consulta buena.");
            }
        } else {
            throw new Exception("No se ha encontrado el archvio de datos de conexion");
        }
    }
    
    public function getSgbd()
    {
        return $this->sgbd;
    }
    
    public function getBase()
    {
        return $this->base;
    }
    
    public function getHost()
    {
        return $this->host;
    }
    
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
}

?>