<?php

/**
 * Clase ProductModel
 *
 * Esta clase se encarga de gestionar los productos en la base de datos.
 */
class ProductModel implements Crudable
{
    /**
     * @var DataBase $database Objeto para interactuar con la base de datos.
     */
    private $database;
    
    /**
     * Constructor de la clase ProductModel.
     */
    public function __construct()
    {
        $this->database = new DataBase('select');
    }
    
    /**
     * Lee todos los productos de la base de datos.
     *
     * @return array Un array de objetos Product.
     */
    public function read()
    {
        $sql = 'SELECT * FROM product';
        $results = $this->database->executarSQL($sql);
        
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    /**
     * Lee todos los productos de la base de datos.
     *
     * @return array Un array de objetos Product.
     */
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
    
    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param Product $obj Objeto Product a crear.
     * @return mixed Resultado de la operación de inserción.
     */
    public function create($obj)
    {
        $sql = 'INSERT INTO product (name, brand, modelCode, price, size, color, sex, img, description, quantity, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [$obj->name, $obj->brand, $obj->modelCode, $obj->price, $obj->size, $obj->color, $obj->sex, $obj->img, $obj->description, $obj->quantity, $obj->discount];
        
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Actualiza un producto en la base de datos.
     *
     * @param Product $obj Objeto Product a actualizar.
     * @return mixed Resultado de la operación de actualización.
     */
    public function update($obj)
    {
        $sql = 'UPDATE product SET name=?, modelCode=?, sex=?, brand=?, price=?, size=?, color=?, img=?, description=?, quantity=?, discount=? WHERE id=?';
        $params = [$obj->name, $obj->modelCode, $obj->sex, $obj->brand, $obj->price, $obj->size, $obj->color, $obj->img, $obj->description, $obj->quantity, $obj->discount, $obj->id];
        
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Elimina un producto de la base de datos.
     *
     * @param Product $obj Objeto Product a eliminar.
     * @return mixed Resultado de la operación de eliminación.
     */
    public function delete($obj)
    {
        $sql = 'DELETE FROM product WHERE id=?';
        $params = [$obj->id];
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Obtiene un producto por su ID.
     *
     * @param Product $obj Objeto Product con el ID a buscar.
     * @return mixed|null Objeto Product encontrado o null si no se encuentra.
     */
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
    
    /**
     * Obtiene una cantidad aleatoria de productos de la base de datos.
     *
     * @param int $quantity Cantidad de productos aleatorios a obtener.
     * @return array Un array de objetos Product.
     * @throws Exception Si no hay suficientes productos disponibles para seleccionar.
     */
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
    
    /**
     * Busca productos que coincidan con una cadena de búsqueda en la base de datos.
     *
     * @param string $searchString Cadena de búsqueda para buscar productos.
     * @return array Un array de objetos Product que coinciden con la búsqueda.
     */
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
        
        $deleteDuplicateProducts = [];
        
        if (!empty($productsFound)) {
            $deleteDuplicateProducts = $this->deleteDuplicate($productsFound);
        }
        
        return (empty($deleteDuplicateProducts)) ? $productsFound : $deleteDuplicateProducts;
    }
    
    /**
     * Lee productos de la base de datos filtrando por sexo.
     *
     * @param string $sexo Sexo por el que filtrar los productos.
     * @return array Un array de objetos Product filtrados por sexo.
     */
    public function readForSex($sexo) {
        $sql = 'SELECT * FROM product WHERE sex = ?';
        $params = [$sexo];
        $results = $this->database->executarSQL($sql, $params);
        
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    /**
     * Lee productos de la base de datos filtrando por nombre y marca.
     *
     * @param FavoritosProduct $obj Objeto FavoritosProduct con el nombre y la marca del producto a buscar.
     * @return array Un array de objetos Product que coinciden con el nombre y la marca especificados.
     */
    public function readForNameBrand($obj) {
        $sql = 'SELECT * FROM product WHERE name = ? and brand = ?';
        $params = [$obj->__get("name"), $obj->__get("brand")];
        
        $results = $this->database->executarSQL($sql, $params);
        $products = $this->deleteDuplicate($results);
        
        return $products;
    }
    
    /**
     * Verifica si existe un producto en la base de datos.
     *
     * @param mixed $search Objeto de búsqueda que contiene el ID del producto a buscar.
     * @return bool true si el producto existe, false de lo contrario.
     */
    public function existProduct($search) {
        $productsAll = $this->readAll();
        foreach ($productsAll as $product) {
            if (intval($search->id) === $product->id) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Obtiene las tallas disponibles para un producto.
     *
     * @param Product $product Objeto Product del que se desean obtener las tallas.
     * @return array Un array de tallas disponibles para el producto.
     */
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
    
    /**
     * Actualiza la cantidad de un producto en la base de datos.
     *
     * @param Product $product Objeto Product del que se desea actualizar la cantidad.
     * @param int $quantity Nueva cantidad del producto.
     * @return mixed Resultado de la operación de actualización.
     */
    public function updateQuantity($product, $quantity)
    {
        $sql = 'UPDATE product SET quantity=? WHERE id=?';
        $params = [$quantity, $product->id];
        
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Obtiene la cantidad disponible de un producto.
     *
     * @param Product $product Objeto Product del que se desea obtener la cantidad.
     * @return int La cantidad disponible del producto.
     */
    public function getQuantity($product)
    {
        $sql = 'SELECT quantity FROM product WHERE id=?';
        $params = [$product->id];
        $result = $this->database->executarSQL($sql, $params);
        
        return $result[0]['quantity'];
    }
    
    /**
     * Elimina duplicados de un array de productos basados en el código de modelo.
     *
     * @param array $results Array de productos a procesar.
     * @return array Un array de productos sin duplicados.
     */
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
    
    /**
     * Convierte un array de rifas en un array de productos.
     *
     * @param array $rifas Un array de objetos Rifa.
     * @return array Un array de objetos Product.
     */
    public function convertRaffleToProduct($rifas)
    {
        $allProducts = [];
        foreach ($rifas as $rifa) {
            $product = $this->getById(new Product($rifa->product_id));
            $allProducts[] = $product;
        }
        
        return $allProducts;
    }
    
    /**
     * Convierte un objeto Product en un array asociativo.
     *
     * @param Product $object El objeto Product a convertir.
     * @return array El array asociativo con los datos del producto.
     */
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
    
    /**
     * Crea un objeto Product a partir de un array de datos.
     *
     * @param array $data El array de datos del producto.
     * @return Product El objeto Product creado.
     */
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
