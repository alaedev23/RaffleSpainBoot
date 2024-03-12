<?php

class FavoritosList {
    
    private $client_id;
    private Array $favoritos = [];
    
    public function __construct() {
        $this->favoritos = [];
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a FavoritosList");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a FavoritosList");
        }
    }

    public function getIndex($index) {
        if (count($this->favoritos)+1 > $index) {
            return $this->favoritos[$index];
        }
    }

    public function addProduct($product) {
        $this->favoritos[] = $product;
    }
    
    public function __debugInfo() {
        return [
            'client_id' => $this->client_id,
            'favoritos' => $this->favoritos
        ];
    }
    
}