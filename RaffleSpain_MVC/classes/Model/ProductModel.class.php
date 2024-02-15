
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
        
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }

    public function create($obj)
    {
        $sql = 'INSERT INTO product (name, brand, modelCode, price, size, color, description, sex, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [$obj->name, $obj->brand, $obj->modelCode, $obj->price, $obj->size, $obj->color, $obj->description, $obj->sex, $obj->img];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE product SET name=?, modelCode=?, sex=?, brand=?, price=?, size=?, color=?, description=?, img=? WHERE id=?';
        $params = [$obj->name, $obj->modelCode, $obj->sex, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->description, $obj->img, $obj->id];
        
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
        $sql = 'SELECT * FROM product WHERE id=? LIMIT 1';
        $params = [$obj->id];
        $result = $this->database->executarSQL($sql, $params);

        if (empty($result)) {
            return null;
        }

        return $this->createProductFromData($result[0]);
    }
    
    public function readForSex($sexo)
    {
        $sql = 'SELECT * FROM product WHERE sex = ?';
        $params = [$sexo];
        $results = $this->database->executarSQL($sql, $params);
        
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    public function deleteDuplicate($results) {
        $resultado = [];
        $modelCodes = [];
        
        foreach ($results as $result) {
            $product = $this->createProductFromData($result);
            $currentModelCode = $product->__get("modelCode");
            
            if (!in_array($currentModelCode, $modelCodes)) {
                $modelCodes[] = $currentModelCode;
                $resultado[] = $product;
            }
        }
        return $resultado;
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
    
    private function createProductFromData($data)
    {
        return new Product(
            $data['id'],
            $data['name'],
            $data['brand'],
            $data['modelCode'],
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

}
