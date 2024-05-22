<?php

/**
 * Class Comment
 *
 * Representa un comentario hecho por un cliente sobre un producto.
 */
class Comment {
    
    /**
     * @var int $id El ID del comentario.
     */
    private $id;
    
    /**
     * @var int $clientId El ID del cliente que hizo el comentario.
     */
    private $clientId;
    
    /**
     * @var int $productId El ID del producto al que se refiere el comentario.
     */
    private $productId;
    
    /**
     * @var string $title El título del comentario.
     */
    private $title;
    
    /**
     * @var string $comment El contenido del comentario.
     */
    private $comment;
    
    /**
     * @var int $value El valor o puntuación asignada al producto.
     */
    private $value;
    
    /**
     * @var string $date La fecha en que se hizo el comentario.
     */
    private $date;
    
    /**
     * Constructor de la clase Comment.
     *
     * @param int $id El ID del comentario.
     * @param int $clientId El ID del cliente que hizo el comentario.
     * @param int $productId El ID del producto al que se refiere el comentario.
     * @param string $title El título del comentario.
     * @param string $comment El contenido del comentario.
     * @param int $value El valor o puntuación asignada al producto.
     * @param string $date La fecha en que se hizo el comentario.
     */
    public function __construct($id, $clientId, $productId, $title, $comment, $value, $date) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->productId = $productId;
        $this->title = $title;
        $this->comment = $comment;
        $this->value = $value;
        $this->date = $date;
    }
    
    /**
     * Establece el valor de una propiedad del comentario.
     *
     * @param string $property El nombre de la propiedad.
     * @param mixed $value El valor a establecer.
     * @throws Exception Si la propiedad no existe.
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Comment");
        }
    }
    
    /**
     * Obtiene el valor de una propiedad del comentario.
     *
     * @param string $property El nombre de la propiedad.
     * @return mixed El valor de la propiedad.
     * @throws Exception Si la propiedad no existe.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Comment");
        }
    }
    
    /**
     * Proporciona información de depuración sobre el comentario.
     *
     * @return array Un array con la información de depuración.
     */
    public function __debugInfo() {
        return [
            'id' => $this->id,
            'client_id' => $this->clientId,
            'product_id' => $this->productId,
            'title' => $this->title,
            'comment' => $this->comment,
            'value' => $this->value,
            'date' => $this->date,
        ];
    }
}
