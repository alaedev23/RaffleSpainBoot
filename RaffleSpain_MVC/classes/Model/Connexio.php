<?php

class Connexio {
    
    private $sgbd;
    private $base;
    private $host;
    private $usuario;
    private $password;
    private const DATOSCONEXION = "classes/Config/DatosConexion.php";
    
    public function __construct($tipoConsulta) {
        if (file_exists(self::DATOSCONEXION)) {
            include 'classes/Config/DatosConexion.php';
            $this->sgbd = $sgbd;
            $this->base = $base;
            $this->host = ini_get('mysqli.default_host');
            $this->host = "localhost"; // 192.168.119.13
            if ($tipoConsulta === 'select' || $tipoConsulta === 'update' || $tipoConsulta === 'delete' || $tipoConsulta === 'insert') {
                $this->usuario = $usuarioSelect;
                $this->password = $passwordSelect;
            } else {
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