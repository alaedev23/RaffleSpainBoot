<?php

class Comment
{

    private $id;
    private $clientId;
    private $productId;
    private $title;
    private $comment;
    private $value;
    private $date;

    public function __construct($id, $clientId, $productId, $title, $comment, $value, $date)
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->productId = $productId;
        $this->title = $title;
        $this->comment = $comment;
        $this->value = $value;
        $this->date = $date;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Product");
        }
    }

    public function __get($property)
    {
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
            'client_id' => $this->clientId,
            'product_id' => $this->productId,
            'title' => $this->title,
            'comment' => $this->comment,
            'value' => $this->value,
            'date' => $this->date,
        ];
    }
}
