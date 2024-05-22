<?php

/**
 * Clase FavoritosProduct
 *
 * Esta clase representa los productos favoritos de un cliente.
 */
class FavoritosProduct {
    
    /**
     * @var int $client_id ID del cliente.
     */
    private $client_id;
    
    /**
     * @var string $product Nombre o identificación del producto.
     */
    private $product;
    
    /**
     * Constructor de la clase FavoritosProduct.
     */
    public function __construct() {}
    
    /**
     * Método mágico para establecer valores de propiedades inaccesibles.
     *
     * @param string $property El nombre de la propiedad.
     * @param mixed $value El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase FavoritosProduct.
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a FavoritosProduct");
        }
    }
    
    /**
     * Método mágico para obtener valores de propiedades inaccesibles.
     *
     * @param string $property El nombre de la propiedad.
     * @return mixed El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase FavoritosProduct.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a FavoritosProduct");
        }
    }
    
    /**
     * Método mágico para obtener información de depuración.
     *
     * @return array Un array asociativo con la información de depuración.
     */
    public function __debugInfo() {
        return [
            'client_id' => $this->client_id,
            'product' => $this->product
        ];
    }
    
}
?>
