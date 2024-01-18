<?php

class Client {
    
    public $id;
    public $name;
    public $password;
    public $surnames;
    public $born;
    public $email;
    public $phone;
    public $sex;
    public $poblation;
    public $address;
    
    public function __construct($id, $name, $password, $surnames, $born = null, $email, $phone, $sex = null, $poblation, $address) {
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
    }
    
}