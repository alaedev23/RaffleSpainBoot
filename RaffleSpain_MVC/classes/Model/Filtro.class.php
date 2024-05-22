<?php

/**
 * Clase Filtro
 *
 * Esta clase representa un conjunto de filtros, búsqueda y orden para la consulta de datos.
 */
class Filtro {
    
    /**
     * @var array $filtros Array de filtros.
     */
    private $filtros;
    
    /**
     * @var string $search Cadena de búsqueda.
     */
    private $search;
    
    /**
     * @var string $order Orden de los resultados.
     */
    private $order;
    
    /**
     * Límite de resultados por consulta.
     */
    private const LIMIT = 15;
    
    /**
     * Constructor de la clase Filtro.
     *
     * @param array $filtros Array de filtros.
     * @param string $order Orden de los resultados.
     * @param string $search Cadena de búsqueda.
     */
    public function __construct($filtros, $order, $search) {
        $this->filtros = $filtros;
        $this->order = $order;
        $this->search = $search;
    }
    
    /**
     * Método mágico para establecer valores de propiedades inaccesibles.
     *
     * @param string $property El nombre de la propiedad.
     * @param mixed $value El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase Filtro.
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Filtro");
        }
    }
    
    /**
     * Método mágico para obtener valores de propiedades inaccesibles.
     *
     * @param string $property El nombre de la propiedad.
     * @return mixed El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase Filtro.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Filtro");
        }
    }
    
    /**
     * Método mágico para obtener información de depuración.
     *
     * @return array Un array asociativo con la información de depuración.
     */
    public function __debugInfo() {
        return [
            'filtros' => $this->filtros,
            'search' => $this->search,
            'order' => $this->order
        ];
    }
    
}
?>
