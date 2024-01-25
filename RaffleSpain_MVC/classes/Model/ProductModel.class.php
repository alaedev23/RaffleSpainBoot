<?php

class ProductModel implements Crudable
{
    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function read()
    {
        $sql = 'SELECT * FROM product';
        $results = $this->database->executarSQL($sql);
    
        $products = [];
        
        foreach ($results as $result) {
            $product = new Product(
                $result['id'],
                $result['name'],
                $result['brand'],
                $result['price'],
                $result['size'],
                $result['color'],
                $result['description'],
                $result['sex'],
                $result['img'],
                $result['quantity'],
                $result['discount']
            );
            $products[] = $product;
        }
    
        return $products;
    }

    public function create($obj)
    {
        $sql = 'INSERT INTO Product (name, brand, price, size, color, description, sex, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [$obj->name, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->description, $obj->sex, $obj->img];
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE Product SET name=?, sex=?, brand=?, price=?, size=?, color=?, description=? WHERE id=?';
        $params = [$obj->name, $obj->sex, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->description, $obj->id];
        return $this->database->executarSQL($sql, $params);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM Product WHERE id=?';
        $params = [$obj->id];
        return $this->database->executarSQL($sql, $params);
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM Product WHERE id=?';
        $params = [$id];
        return $this->database->executarSQL($sql, $params);
    }
}
