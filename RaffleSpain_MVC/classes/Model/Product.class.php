<?php
class Product
{
    private $id;
    private $name;
    private $brand;
    private $modelCode;
    private $price;
    private $size;
    private $color;
    private $description;
    private $sex;
    private $img;
    private $quantity;
    private $discount;

    public function __construct($id, $name=null, $brand=null, $modelCode=null, $price=null, $size=null, $color=null, $description=null, $sex=null, $img=null, $quantity=null, $discount=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->modelCode = $modelCode;
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
            'modelCode' => $this->modelCode,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'description' => $this->description,
            'sex' => $this->sex,
            'img' => $this->img,
            'quantity' => $this->quantity,
            'discount' => $this->discount
        ];
    }
}
