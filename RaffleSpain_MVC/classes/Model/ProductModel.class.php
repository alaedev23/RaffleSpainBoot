
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
            $product = $this->createProductFromData($result);
            $products[] = $product;
        }

        return $products;
    }

    public function create($obj)
    {
        $sql = 'INSERT INTO product (name, brand, price, size, color, description, sex, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [$obj->name, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->description, $obj->sex, $obj->img];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE product SET name=?, sex=?, brand=?, price=?, size=?, color=?, description=? WHERE id=?';
        $params = [$obj->name, $obj->sex, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->description, $obj->id];
        
        $this->database->executarSQL($sql, $params);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM product WHERE id=?';
        $params = [$obj->id];
        
        $this->database->executarSQL($sql, $params);
        return $obj;
    }

    public function getById($obj)
    {
        $sql = 'SELECT * FROM product WHERE id=?';
        $params = [$obj->id];
        $result = $this->database->executarSQL($sql, $params);

        if (empty($result)) {
            return null;
        }

        return $this->createProductFromData($result[0]);
    }

    private function createProductFromData($data)
    {
        return new Product(
            $data['id'],
            $data['name'],
            $data['brand'],
            $data['price'],
            $data['size'],
            $data['color'],
            $data['description'],
            $data['sex'],
            $data['img'],
            $data['quantity'],
            $data['discount']
        );
    }

    public function getTallas($product){

        $productName = $product->__get('name');
        $brand = $product->__get('brand');

        $sql = 'SELECT DISTINCT size FROM product WHERE name=? AND brand=?';
        $params = [$productName, $brand];
        $results = $this->database->executarSQL($sql, $params);

        $tallas = [];

        foreach ($results as $result) {
            $tallas[] = $result['size'];
        }
        
        return $tallas;
    }

    public function readForSex($sexo)
    {
        $sql = 'SELECT * FROM product where sex = ?';
        $params = [$sexo];
        $results = $this->database->executarSQL($sql, $params);

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

}
