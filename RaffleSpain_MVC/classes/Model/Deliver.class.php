<?php

class Deliver {

    private $id;
    private $client_id;
    private $date;
    private $date_deliver;
    private $product;
    private $quantity;

    public function __construct($id = null, $client_id = null, $date = null, $date_deliver = null, $product = null, $quantity = null) {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->date = $date;
        $this->date_deliver = $date_deliver;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Deliver");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Deliver");
        }
    }

    public function __debugInfo() {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'date' => $this->date,
            'date_deliver' => $this->date_deliver,
            'product' => $this->product,
            'quantity' => $this->quantity
        ];
    }

}