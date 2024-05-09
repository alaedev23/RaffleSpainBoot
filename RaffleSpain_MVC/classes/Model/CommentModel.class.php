<?php

class CommentModel implements Crudable {
    
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
    
    public function delete($obj) {
        $database = new DataBase('delete');
        
        $result = $database->executarSQL("DELETE FROM comment WHERE id = ?", [$obj->id]);
        
        return $result;
    }
    
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
