<?php

/**
 * Clase FavoritosProductModel
 *
 * Esta clase proporciona métodos para gestionar los productos favoritos de un cliente en la base de datos.
 */
class FavoritosProductModel {
    
    /**
     * Lee los productos favoritos de un cliente.
     *
     * @param FavoritosProduct $obj El objeto FavoritosProduct con la información del cliente.
     * @return array Un array de objetos FavoritosProduct que contiene los productos favoritos del cliente.
     */
    public function read($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM favoritos where client_id = ?", [$obj->client_id]);
        
        $productModel = new ProductModel();
        $carretoArray = [];
        
        foreach ($resultado as $fila) {
            $carretoObj = new FavoritosProduct();
            $product = new Product($fila["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            $carretoArray[] = $carretoObj;
        }
        
        return $carretoArray;
    }
    
    /**
     * Lee un producto favorito de un cliente por ID de cliente y de producto.
     *
     * @param FavoritosProduct $obj El objeto FavoritosProduct con la información del cliente y del producto.
     * @return FavoritosProduct|null El objeto FavoritosProduct encontrado o null si no se encuentra.
     */
    public function readByClientAndProduct($obj) {
        $database = new DataBase('select');
        $resultado = $database->executarSQL("SELECT * FROM favoritos where client_id = ? AND product_id = ?", [$obj->client_id, $obj->product->id]);
        
        $productModel = new ProductModel();
        
        if (!empty($resultado)) {
            $carretoObj = new FavoritosProduct();
            $product = new Product($resultado[0]["product_id"]);
            $product = $productModel->getById($product);
            $carretoObj->product = $product;
            $carretoObj->client_id = $obj->client_id;
            return $carretoObj;
        }
        
        return null;
    }
    
    /**
     * Crea un nuevo producto favorito para un cliente.
     *
     * @param FavoritosProduct $obj El objeto FavoritosProduct con la información del cliente y del producto.
     * @return mixed El resultado de la operación de inserción.
     */
    public function create($obj) {
        $database = new DataBase('insert');
        
        $params = [$obj->client_id, $obj->product->id];
        
        $resultado = $database->executarSQL("INSERT INTO favoritos (client_id, product_id) VALUES (?, ?)", $params);
        return $resultado;
    }
    
    /**
     * Elimina todos los productos favoritos de un cliente por su ID.
     *
     * @param FavoritosProduct $obj El objeto FavoritosProduct con la información del cliente.
     * @return mixed El resultado de la operación de eliminación.
     */
    public function deleteByClientId($obj) {
        $database = new DataBase('delete');
        
        $params = [$obj->id];
        
        $resultado = $database->executarSQL("DELETE FROM favoritos WHERE client_id = ?", $params);
        
        return $resultado;
    }
    
    /**
     * Elimina un producto favorito por su ID.
     *
     * @param FavoritosProduct $obj El objeto FavoritosProduct con la información del producto.
     * @return mixed El resultado de la operación de eliminación.
     */
    public function deleteById($obj) {
        $database = new DataBase('delete');
        
        $params = [$obj->id];
        
        $resultado = $database->executarSQL("DELETE FROM favoritos WHERE product_id = ?", $params);
        
        return $resultado;
    }
    
}
?>
