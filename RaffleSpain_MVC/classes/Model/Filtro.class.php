<?php

class Filtro {
    
    private $filtros;
    private $search;
    private $order;
    private const LIMIT = 15;

    public function __construct($filtros, $order, $search) {
        $this->filtros = $filtros;
        $this->order = $order;
        $this->search = $search;
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Entrada");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Entrada");
        }
    }
    
    public function __debugInfo() {
        return [
            'filtros' => $this->filtros,
            'search' => $this->search,
            'order' => $this->order
        ];
    }
    
}