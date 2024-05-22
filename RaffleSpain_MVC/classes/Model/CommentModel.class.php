<?php

/**
 * Clase CommentModel
 *
 * Esta clase maneja las operaciones CRUD para la entidad Comment.
 */
class CommentModel implements Crudable {
    
    /**
     * Lee todos los comentarios de la base de datos.
     *
     * @param mixed $obj No se utiliza en este método.
     * @return array Un array de objetos Comment.
     */
    public function read($obj = null) {
        $database = new DataBase('select');
        $result = $database->executarSQL("SELECT * FROM comment");
        
        $comments = [];
        
        foreach ($result as $row) {
            $commentObj = $this->createCommentFromData($row);
            $comments[] = $commentObj;
        }
        
        return $comments;
    }
    
    /**
     * Crea un nuevo comentario en la base de datos.
     *
     * @param Comment $obj El objeto Comment a crear.
     * @return mixed El resultado de la operación de creación.
     */
    public function create($obj) {
        $database = new DataBase('insert');
        
        $params = [
            $obj->clientId,
            $obj->productId,
            $obj->title,
            $obj->comment,
            $obj->value,
            $obj->date
        ];
        
        $result = $database->executarSQL("INSERT INTO comment (client_id, product_id, title, comment, value, date) VALUES (?, ?, ?, ?, ?, ?)", $params);
        
        return $result;
    }
    
    /**
     * Actualiza un comentario en la base de datos.
     *
     * @param Comment $obj El objeto Comment a actualizar.
     * @return mixed El resultado de la operación de actualización.
     */
    public function update($obj) {
        $database = new DataBase('update');
        
        $params = [
            $obj->clientId,
            $obj->productId,
            $obj->title,
            $obj->comment,
            $obj->value,
            $obj->date,
            $obj->id
        ];
        
        $result = $database->executarSQL("UPDATE comment SET client_id = ?, product_id = ?, title = ?, comment = ?, value = ?, date = ? WHERE id = ?", $params);
        
        return $result;
    }
    
    /**
     * Obtiene todos los comentarios asociados a un producto.
     *
     * @param Comment $obj El objeto Comment que contiene el ID del producto.
     * @return array|null Un array de objetos Comment o null si no se encuentran comentarios para el producto.
     */
    public function getById($obj) {
        $database = new DataBase('select');
        
        $sql = 'SELECT * FROM comment WHERE product_id = ?';
        $params = [$obj->id];
        
        $result = $database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        $comments = [];
        
        foreach ($result as $row) {
            $commentObj = $this->createCommentFromData($row);
            $comments[] = $commentObj;
        }
        
        return $comments;
    }
    
    /**
     * Elimina un comentario de la base de datos.
     *
     * @param Comment $obj El objeto Comment a eliminar.
     * @return mixed El resultado de la operación de eliminación.
     */
    public function delete($obj) {
        $database = new DataBase('delete');
        
        $result = $database->executarSQL("DELETE FROM comment WHERE id = ?", [$obj->id]);
        
        return $result;
    }
    
    /**
     * Crea un objeto Comment a partir de los datos obtenidos de la base de datos.
     *
     * @param array $data Los datos del comentario obtenidos de la base de datos.
     * @return Comment El objeto Comment creado.
     */
    private function createCommentFromData($data) {
        return new Comment (
            $data['id'],
            $data['client_id'],
            $data['product_id'],
            $data['title'],
            $data['comment'],
            $data['value'],
            $data['date']
            );
    }
}
