<?php

class CistellaList {
    
    private $client_id;
    private Array $carreto;
    
    public function __construct() {
        $this->carreto = [];
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Raffle");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Raffle");
        }
    }

    public function getIndex($index) {
        if (count($this->carreto)+1 > $index) {
            return $this->carreto[$index];
        }
    }

    public function addProduct(Product $product) {
        $this->carreto[] = $product;
    }
    
    public function __debugInfo() {
        return [
            'client_id' => $this->client_id,
            'favoritos' => $this->carreto
        ];
    }
    
}