<?php

class Raffle {
    
    private $id;
    private $product_id;
    private $date_start;
    private $date_end;
    private $product;
    private $winner;
    private $type;
    
    public function __construct($id = null, $product_id = null, $date_start = null, $date_end = null, Product $product = null, $winner = null, $type = 0) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->product = $product;
        $this->winner = $winner;
        $this->type = $type;
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
    
    public function __debugInfo() {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'product' => $this->product,
            'winner' => $this->winner,
            'type' => $this->type
        ];
    }
    
}