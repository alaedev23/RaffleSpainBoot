<?php

/**
 * Class CistellaProduct
 *
 * Esta clase representa un producto en una cesta de compra.
 * Incluye información sobre el cliente, el producto, la cantidad y el tamaño.
 */
class CistellaProduct {
    
    /**
     * @var int $client_id Identificador del cliente.
     */
    private $client_id;
    
    /**
     * @var string $product Nombre del producto.
     */
    private $product;
    
    /**
     * @var int $quantity Cantidad del producto.
     */
    private $quantity;
    
    /**
     * @var string $size Tamaño del producto.
     */
    private $size;
    
    /**
     * Constructor de la clase CistellaProduct.
     */
    public function __construct() {}
    
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
            throw new Exception("No existeix la propietat $property a CistellaProduct");
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
            throw new Exception("No existeix la propietat $property a CistellaProduct");
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
            'client_id' => $this->client_id,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'size' => $this->size
        ];
    }
}
?>
