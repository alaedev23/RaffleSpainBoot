<?php

/**
 * Clase DataBase
 *
 * Esta clase se encarga de gestionar la conexión a una base de datos y la ejecución de consultas SQL.
 */
class DataBase {
    
    /**
     * @var mysqli $link Enlace de conexión a la base de datos.
     */
    private $link;
    
    /**
     * @var Connexio $conexion Instancia de la clase Connexio.
     */
    private $conexion;
    
    /**
     * Constructor de la clase DataBase.
     *
     * @param string $tipoConsulta Tipo de consulta a realizar (select, update, delete, insert).
     * @throws Exception Si el tipo de consulta no es válido o si no se puede conectar a la base de datos.
     */
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
                    // Futura implementación para PostgreSQL
                    break;
                case 'oracle' :
                    // Futura implementación para Oracle
                    break;
                case 'mongodb' :
                    // Futura implementación para MongoDB
                    break;
            }
        } else {
            throw new Exception("La consulta '$tipoConsulta' no es una consulta buena.");
        }
    }
    
    /**
     * Destructor de la clase DataBase.
     *
     * Cierra la conexión a la base de datos.
     */
    public function __destruct() {
        $this->link->close();
    }
    
    /**
     * Ejecuta una consulta SQL.
     *
     * @param string $sSql La consulta SQL a ejecutar.
     * @param array|null $aParam Parámetros para la consulta preparada.
     * @return mixed El resultado de la consulta o un mensaje de éxito o error.
     */
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
                    $resultado = "La consulta se ha realizado con éxito";
                }
            } else {
                $resultado = "Error al ejecutar la consulta: " . $stmt->error;
            }
        } else {
            $resultado = "Error en la preparación";
        }
        return $resultado;
    }
    
    /**
     * Obtiene el ID del último registro insertado.
     *
     * @return int El ID del último registro insertado.
     */
    public function getLastInsertedId()
    {
        return $this->link->insert_id;
    }
    
    /**
     * Obtiene el enlace de conexión a la base de datos.
     *
     * @return mysqli El enlace de conexión a la base de datos.
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * Obtiene la instancia de la clase Connexio.
     *
     * @return Connexio La instancia de la clase Connexio.
     */
    public function getConexion()
    {
        return $this->conexion;
    }
    
} 