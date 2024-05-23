<?php

/**
 * Class CistellaProductModel
 *
 * Esta clase maneja las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para los productos en la cesta de compras.
 */
class CistellaProductModel {
    
    /**
     * Lee todos los productos en la cesta de un cliente.
     *
     * @param CistellaProduct $obj Objeto que contiene el ID del cliente.
     *
     * @return array Array de objetos CistellaProduct.
     */
    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM carreto where client_id = ?", [$obj->client_id]);
        
        $productModel = new ProductModel();
        $carretoArray = [];
        
        foreach ($resultado as $fila) {
            $carretoObj = new CistellaProduct();
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            $carretoObj->quantity = $fila["quantity"];
            $carretoObj->size = $fila["talla"];
            $carretoArray[] = $carretoObj;
        }
        
        return $carretoArray;
    }
    
    /**
     * Lee un producto específico en la cesta de un cliente.
     *
     * @param CistellaProduct $obj Objeto que contiene el ID del cliente y el producto.
     *
     * @return CistellaProduct|null El objeto CistellaProduct o null si no se encuentra.
     */
    public function readByClientAndProduct($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM carreto where client_id = ? AND product_id = ?", [$obj->client_id, $obj->product->id]);
        
        $productModel = new ProductModel();
        
        if (!empty($resultado)) {
            $carretoObj = new CistellaProduct();
            $product = new Product($resultado[0]["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            return $carretoObj;
        }
        
        return null;
    }
    
    /**
     * Crea un nuevo registro en la cesta de compras.
     *
     * @param CistellaProduct $obj Objeto que contiene la información del producto y cliente.
     *
     * @return mixed El resultado de la operación de inserción.
     */
    public function create($obj) {
        $database = new DataBase('insert');
        
        $params = [$obj->client_id, $obj->product->id, $obj->size];
        
        $resultado = $database->executarSQL("INSERT INTO carreto (client_id, product_id, talla) VALUES (?, ?, ?)", $params);
        return $resultado;
    }
    
    /**
     * Actualiza la cantidad de un producto en la cesta de compras.
     *
     * @param CistellaProduct $obj Objeto que contiene la información actualizada del producto y cliente.
     *
     * @return mixed El resultado de la operación de actualización.
     */
    public function update($obj) {
        $database = new DataBase('update');
        
        $params = [$obj->quantity, $obj->client_id, $obj->product->id, $obj->size];
        
        $resultado = $database->executarSQL("UPDATE carreto SET quantity = ? WHERE client_id = ? AND product_id = ? AND talla = ?", $params);
        
        return $resultado;
    }
    
    /**
     * Actualiza la cantidad y el tamaño de un producto en la cesta de compras.
     *
     * @param CistellaProduct $obj Objeto que contiene la información actualizada del producto y cliente.
     *
     * @return mixed El resultado de la operación de actualización.
     */
    public function updateQuantityAndSize($obj) {
        $database = new DataBase('update');
        
        $params = [$obj->quantity, $obj->size, $obj->client_id];
        
        $resultado = $database->executarSQL("UPDATE carreto SET quantity = ?, talla = ? WHERE client_id = ?", $params);
        
        return $resultado;
    }
    
    /**
     * Elimina todos los productos en la cesta de un cliente.
     *
     * @param $obj Objeto que contiene el ID del cliente.
     *
     * @return mixed El resultado de la operación de eliminación.
     */
    public function deleteByClientId($obj) {
        $database = new DataBase('delete');
        
        $params = [$obj->id];
        
        $resultado = $database->executarSQL("DELETE FROM carreto WHERE client_id = ?", $params);
        
        return $resultado;
    }
    
    /**
     * Elimina un producto específico en la cesta de compras.
     *
     * @param $obj Objeto que contiene el ID del producto.
     *
     * @return mixed El resultado de la operación de eliminación.
     */
    public function deleteById($obj) {
        $database = new DataBase('delete');
        
        $params = [$obj->id];
        
        $resultado = $database->executarSQL("DELETE FROM carreto WHERE product_id = ?", $params);
        
        return $resultado;
    }
    
}

