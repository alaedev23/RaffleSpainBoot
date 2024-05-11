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
    
    public function readAll()
    {
        $sql = 'SELECT * FROM product';
        $results = $this->database->executarSQL($sql);
        
        $productos = [];
        
        foreach ($results as $fila) {
            $productObj = $this->createProductFromData($fila);
            $productos[] = $productObj;
        }
        
        return $productos;
    }

    public function create($obj)
    {
        $sql = 'INSERT INTO product (name, brand, modelCode, price, size, color, sex, img, description, quantity, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [$obj->name, $obj->brand, $obj->modelCode, $obj->price, $obj->size, $obj->color, $obj->sex, $obj->img, $obj->description, $obj->quantity, $obj->discount];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE product SET name=?, modelCode=?, sex=?, brand=?, price=?, size=?, color=?, img=?, description=?, quantity=?, discount=? WHERE id=?';
        $params = [$obj->name, $obj->modelCode, $obj->sex, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->img, $obj->description, $obj->quantity, $obj->discount, $obj->id];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM product WHERE id=?';
        $params = [$obj->id];
        return $this->database->executarSQL($sql, $params);
    }

    public function getById($obj)
    {
        $sql = 'SELECT * FROM product WHERE id=? LIMIT 1';
        $params = [$obj->id];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result[0])) {
            return null;
        }
        
        return $this->createProductFromData($result[0]);
    }
    
    public function getRandomProducts($quantity) {
        $products = $this->read();
        $totalProducts = count($products);
        
        if ($totalProducts < $quantity) {
            throw new Exception("No hay suficientes productos disponibles para seleccionar.");
        }
        
        $randomProducts = [];
        $selectedIndexes = [];
        while (count($randomProducts) < $quantity) {
            $randomIndex = mt_rand(0, $totalProducts - 1);
            
            if (!in_array($randomIndex, $selectedIndexes)) {
                $randomProducts[] = $products[$randomIndex];
                $selectedIndexes[] = $randomIndex;
            }
        }
        
        return $randomProducts;
    }

    public function searchProduct($searchString) {
        $allProducts = $this->readAll();
        $searchReady = strtolower(trim($searchString));
        
        $productsFound = [];
        if (!empty($allProducts)) {
            foreach ($allProducts as $product) {
                $nameBrand = strtolower($product->__get("brand")) . " " . strtolower($product->__get("name"));
                if (str_contains(strtolower($product->__get("name")), $searchReady) ||
                    str_contains(strtolower($product->__get("brand")), $searchReady) ||
                    str_contains(strtolower($product->__get("color")), strtolower($searchString)) ||
                    str_contains($nameBrand, strtolower($searchString))) {
                        array_push($productsFound, $product);
                    }   
            }
        }
        
//         if (empty($productsFound)) {
//             foreach ($allProducts as $product) {
//                 // Normaliza el nombre del producto y la marca, y los une en una sola cadena
//                 $nameBrand = strtolower($product->__get("brand")) . " " . strtolower($product->__get("name"));
                
//                 // Divide la cadena de búsqueda en tokens individuales
//                 $searchTokens = explode(" ", $searchReady);
                
//                 // Divide el nombre del producto en tokens individuales
//                 $productTokens = explode(" ", strtolower($nameBrand));
                
//                 // Verifica si hay coincidencias entre los tokens
//                 $match = false;
//                 foreach ($searchTokens as $searchToken) {
//                     foreach ($productTokens as $productToken) {
//                         // Comprueba si el token de búsqueda está contenido en el token del producto
//                         if (str_contains($productToken, $searchToken) || str_contains($searchToken, $productToken)) {
//                             $match = true;
//                             break 2; // Sale de ambos bucles foreach
//                         }
//                     }
//                 }
                
//                 if ($match) {
//                     array_push($productsFound, $product);
//                 }   
//             }
//         }
        
        $deleteDuplicateProducts = [];
        
        if (!empty($productsFound)) {
            $deleteDuplicateProducts = $this->deleteDuplicate($productsFound);
        }
        
        return (empty($deleteDuplicateProducts)) ? $productsFound : $deleteDuplicateProducts;
    }
    
    public function readForSex($sexo) {
        $sql = 'SELECT * FROM product WHERE sex = ?';
        $params = [$sexo];
        $results = $this->database->executarSQL($sql, $params);
        
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    public function readForNameBrand($obj) {
        $sql = 'SELECT * FROM product WHERE name = ? and brand = ?';
        $params = [$obj->__get("name"), $obj->__get("brand")];
        
        $results = $this->database->executarSQL($sql, $params);
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    public function existProduct($search) {
        $productsAll = $this->readAll();
        foreach ($productsAll as $product) {
            if (intval($search->id) === $product->id) {
                return true;
            }
        }
        return false;
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

    public function updateQuantity($product, $quantity)
    {
        $sql = 'UPDATE product SET quantity=? WHERE id=?';
        $params = [$quantity, $product->id];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function getQuantity($product)
    {
        $sql = 'SELECT quantity FROM product WHERE id=?';
        $params = [$product->id];
        $result = $this->database->executarSQL($sql, $params);
        
        return $result[0]['quantity'];
    }
    
    public function deleteDuplicate($results) {
        $resultado = [];
        $modelCodes = [];
        
        foreach ($results as $result) {
            $dataArray = [];
            if ($result instanceof Product) {
                $dataArray = $this->productToArray($result);
            } else {
                $dataArray = $result;
            }
            
            $product = $this->createProductFromData($dataArray);            
            $currentModelCode = $product->__get("modelCode");
            
            if (!in_array($currentModelCode, $modelCodes)) {
                $modelCodes[] = $currentModelCode;
                $resultado[] = $product;
            }
        }
        return $resultado;
    }
    
    public function convertRaffleToProduct($rifas) 
    {
        $allProducts = [];
        foreach ($rifas as $rifa) {
            $product = $this->getById(new Product($rifa->product_id));
            $allProducts[] = $product;
        }
        
        return $allProducts;
    }
    
    public function productToArray($object) {
        $dataArray = [
            "id" => $object->id,
            "name" => $object->name,
            "brand" => $object->brand,
            "modelCode" => $object->modelCode,
            "price" => $object->price,
            "size" => $object->size,
            "color" => $object->color,
            "sex" => $object->sex,
            "img" => $object->img,
            "description" => $object->description,
            "quantity" => $object->quantity,
            "discount" => $object->discount
        ];
        return $dataArray;
    }
    
    public function createProductFromData($data)
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
