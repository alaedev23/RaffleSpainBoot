<?php

/**
 * Clase Connexio
 *
 * Esta clase se encarga de gestionar la conexión a una base de datos.
 */
class Connexio {
    
    /**
     * @var string $sgbd Sistema de gestión de bases de datos.
     */
    private $sgbd;
    
    /**
     * @var string $base Nombre de la base de datos.
     */
    private $base;
    
    /**
     * @var string $host Dirección del servidor de base de datos.
     */
    private $host;
    
    /**
     * @var string $usuario Nombre de usuario para la conexión.
     */
    private $usuario;
    
    /**
     * @var string $password Contraseña para la conexión.
     */
    private $password;
    
    /**
     * Ruta del archivo de datos de conexión.
     */
    private const DATOSCONEXION = "classes/Config/DatosConexion.php";
    
    /**
     * Constructor de la clase Connexio.
     *
     * @param string $tipoConsulta Tipo de consulta a realizar (select, update, delete, insert).
     * @throws Exception Si el tipo de consulta no es válido o si el archivo de datos de conexión no se encuentra.
     */
    public function __construct($tipoConsulta) {
        if (file_exists(self::DATOSCONEXION)) {
            include 'classes/Config/DatosConexion.php';
            $this->sgbd = $sgbd;
            $this->base = $base;
            $this->host = ini_get('mysqli.default_host');
            $this->host = "localhost";
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
    
    /**
     * Obtiene el sistema de gestión de bases de datos.
     *
     * @return string El sistema de gestión de bases de datos.
     */
    public function getSgbd()
    {
        return $this->sgbd;
    }
    
    /**
     * Obtiene el nombre de la base de datos.
     *
     * @return string El nombre de la base de datos.
     */
    public function getBase()
    {
        return $this->base;
    }
    
    /**
     * Obtiene la dirección del servidor de base de datos.
     *
     * @return string La dirección del servidor de base de datos.
     */
    public function getHost()
    {
        return $this->host;
    }
    
    /**
     * Obtiene el nombre de usuario para la conexión.
     *
     * @return string El nombre de usuario para la conexión.
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    /**
     * Obtiene la contraseña para la conexión.
     *
     * @return string La contraseña para la conexión.
     */
    public function getPassword()
    {
        return $this->password;
    }
    
}

?>
