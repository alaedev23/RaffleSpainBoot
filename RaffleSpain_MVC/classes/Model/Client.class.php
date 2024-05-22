<?php

/**
 * Class Client
 *
 * Esta clase representa un cliente con toda su información personal y de contacto.
 */
class Client {
    
    /**
     * @var int $id Identificador del cliente.
     */
    private $id;
    
    /**
     * @var string|null $name Nombre del cliente.
     */
    private $name;
    
    /**
     * @var string|null $password Contraseña del cliente.
     */
    private $password;
    
    /**
     * @var string|null $surnames Apellidos del cliente.
     */
    private $surnames;
    
    /**
     * @var string|null $born Fecha de nacimiento del cliente.
     */
    private $born;
    
    /**
     * @var string|null $email Correo electrónico del cliente.
     */
    private $email;
    
    /**
     * @var string|null $phone Teléfono del cliente.
     */
    private $phone;
    
    /**
     * @var string|null $sex Sexo del cliente.
     */
    private $sex;
    
    /**
     * @var string|null $poblation Población del cliente.
     */
    private $poblation;
    
    /**
     * @var string|null $address Dirección del cliente.
     */
    private $address;
    
    /**
     * @var int $type Tipo de cliente (0 por defecto).
     */
    private $type;
    
    /**
     * @var int $floor Piso del cliente (1 por defecto).
     */
    private $floor;
    
    /**
     * @var int $door Puerta del cliente (1 por defecto).
     */
    private $door;
    
    /**
     * @var int $postal_code Código postal del cliente (00000 por defecto).
     */
    private $postal_code;
    
    /**
     * Constructor de la clase Client.
     *
     * @param int $id Identificador del cliente.
     * @param string|null $name Nombre del cliente.
     * @param string|null $password Contraseña del cliente.
     * @param string|null $surnames Apellidos del cliente.
     * @param string|null $born Fecha de nacimiento del cliente.
     * @param string|null $email Correo electrónico del cliente.
     * @param string|null $phone Teléfono del cliente.
     * @param string|null $sex Sexo del cliente.
     * @param string|null $poblation Población del cliente.
     * @param string|null $address Dirección del cliente.
     * @param int $type Tipo de cliente.
     * @param int $floor Piso del cliente.
     * @param int $door Puerta del cliente.
     * @param int $postal_code Código postal del cliente.
     */
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
    
    /**
     * Método mágico __set.
     *
     * Permite asignar valores a las propiedades privadas de la clase.
     *
     * @param string $property El nombre de la propiedad.
     * @param mixed $value El valor a asignar a la propiedad.
     *
     * @throws Exception Si la propiedad no existe.
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Client");
        }
    }
    
    /**
     * Método mágico __get.
     *
     * Permite acceder a las propiedades privadas de la clase.
     *
     * @param string $property El nombre de la propiedad.
     *
     * @return mixed El valor de la propiedad.
     *
     * @throws Exception Si la propiedad no existe.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Client");
        }
    }
    
    /**
     * Método mágico __debugInfo.
     *
     * Proporciona información de depuración sobre el objeto.
     *
     * @return array Un array asociativo con las propiedades del objeto.
     */
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
?>
