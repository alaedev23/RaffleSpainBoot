<?php

/**
 * La clase Raffle representa una rifa.
 */
class Raffle {
    
    /**
     * @var int|null Identificador de la rifa.
     */
    private $id;
    
    /**
     * @var int|null Identificador del producto asociado a la rifa.
     */
    private $product_id;
    
    /**
     * @var string|null Fecha de inicio de la rifa.
     */
    private $date_start;
    
    /**
     * @var string|null Fecha de finalización de la rifa.
     */
    private $date_end;
    
    /**
     * @var Product|null Producto asociado a la rifa.
     */
    private $product;
    
    /**
     * @var string|null Ganador de la rifa.
     */
    private $winner;
    
    /**
     * @var int Tipo de la rifa (por defecto: 0).
     */
    private $type;
    
    /**
     * Constructor de la clase Raffle.
     *
     * @param int|null $id Identificador de la rifa.
     * @param int|null $product_id Identificador del producto asociado a la rifa.
     * @param string|null $date_start Fecha de inicio de la rifa.
     * @param string|null $date_end Fecha de finalización de la rifa.
     * @param Product|null $product Producto asociado a la rifa.
     * @param string|null $winner Ganador de la rifa.
     * @param int $type Tipo de la rifa (por defecto: 0).
     */
    public function __construct($id = null, $product_id = null, $date_start = null, $date_end = null, Product $product = null, $winner = null, $type = 0) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->product = $product;
        $this->winner = $winner;
        $this->type = $type;
    }
    
    /**
     * Setter mágico para establecer el valor de una propiedad.
     *
     * @param string $property Nombre de la propiedad.
     * @param mixed $value Valor a establecer.
     * @throws Exception Si la propiedad no existe en la clase.
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Raffle");
        }
    }
    
    /**
     * Getter mágico para obtener el valor de una propiedad.
     *
     * @param string $property Nombre de la propiedad.
     * @return mixed El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Raffle");
        }
    }
    
    /**
     * Método de información de depuración.
     *
     * @return array Un array con la información de la rifa.
     */
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
