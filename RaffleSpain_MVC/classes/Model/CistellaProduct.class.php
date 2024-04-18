<?php

class CistellaProduct {
    
    private $client_id;
    private $product;
    private $quantity;
    private $size;
    
    public function __construct() {}
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a CistellaProduct");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a CistellaProduct");
        }
    }
    
    public function __debugInfo() {
        return [
            'client_id' => $this->client_id,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'size' => $this->size
        ];
    }
    
}