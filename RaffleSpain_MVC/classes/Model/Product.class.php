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
    private $sex;
    private $img;
    private $quantity;
    private $discount;

    public function __construct($id, $name, $brand, $price, $size, $color, $description, $sex, $img, $quantity, $discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->size = $size;
        $this->color = $color;
        $this->description = $description;
        $this->sex = $sex;
        $this->img = $img;
        $this->quantity = $quantity;
        $this->discount = $discount;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Product");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Product");
        }
    }

    public function __debugInfo()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'description' => $this->description,
            'img' => $this->img,
            'quantity' => $this->quantity,
            'discount' => $this->discount
        ];
    }
}
