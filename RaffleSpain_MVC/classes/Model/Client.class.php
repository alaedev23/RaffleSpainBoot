<?php

class Client {
    
    private $id;
    private $name;
    private $password;
    private $surnames;
    private $born;
    private $email;
    private $phone;
    private $sex;
    private $poblation;
    private $address;
    private $type;
    private $floor;
    private $door;
    private $postal_code;
    
    public function __construct($id, $name = null, $password = null, $surnames = null, $born = null, $email = null, $phone = null, $sex = null, $poblation = null, $address = null, $type = 0, $floor = 1, $door = 1, $postal_code = 00000) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->surnames = $surnames;
        $this->born = $born;
        $this->email = $email;
        $this->phone = $phone;
        $this->sex = $sex;
        $this->poblation = $poblation;
        $this->address = $address;
        $this->type = $type;
        $this->floor = $floor;
        $this->door = $door;
        $this->postal_code = $postal_code;
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Client");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Client");
        }
    }
    
    public function __debugInfo() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'password' => $this->password,
            'surnames' => $this->surnames,
            'born' => $this->born,
            'email' => $this->email,
            'phone' => $this->phone,
            'sex' => $this->sex,
            'poblation' => $this->poblation,
            'address' => $this->address,
            'type' => $this->type,
            'floor' => $this->floor,
            'door' => $this->door,
            'postal_code' => $this->postal_code
        ];
    }
    
}