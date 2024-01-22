<?php

class ProductModel implements Crudable
{
    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function read($obj = null)
    {
        $sql = 'SELECT * FROM Product';
        $results = $this->database->executarSQL($sql);
    
        $products = [];
        
        foreach ($results as $result) {
            $product = new Product(
                $result['name'],
                $result['brand'],
                $result['price'],
                $result['size'],
                $result['color'],
                $result['description']
            );
            $product->__set('id',$result['id']);
            $products[] = $product;
        }
    
        return $products;
    }
    

    public function create($obj)
    {
        $sql = 'INSERT INTO Product (name, brand, price, size, color, description) VALUES (?, ?, ?, ?, ?, ?)';
        $params = [$obj->getName(), $obj->getBrand(), $obj->getPrice(), $obj->getSize(), $obj->getColor(), $obj->getDescription()];
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE Product SET name=?, brand=?, price=?, size=?, color=?, description=? WHERE id=?';
        $params = [$obj->getName(), $obj->getBrand(), $obj->getPrice(), $obj->getSize(), $obj->getColor(), $obj->getDescription(), $obj->getId()];
        return $this->database->executarSQL($sql, $params);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM Product WHERE id=?';
        $params = [$obj->getId()];
        return $this->database->executarSQL($sql, $params);
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM Product WHERE id=?';
        $params = [$id];
        return $this->database->executarSQL($sql, $params);
    }
}

?>