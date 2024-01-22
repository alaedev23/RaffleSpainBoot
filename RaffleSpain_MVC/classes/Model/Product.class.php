<?php
class Product
{
    private $id;
    private $name;
    private $brand;
    private $price;
    private $size;
    private $color;
    private $description;

    public function __construct($id, $name, $brand, $price, $size, $color, $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->size = $size;
        $this->color = $color;
        $this->description = $description;
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
}
