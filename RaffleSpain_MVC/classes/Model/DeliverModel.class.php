
<?php

class DeliverModel {

    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function getDeliver($id) {
        $query = "SELECT * FROM deliver WHERE id = ?";
        $params = [$id];
        $result = $this->database->executarSQL($query, $params);
        
        $delivers = [];
        
        $mProduct = new ProductModel();
        
        foreach ($result as $row) {
            
            $query2 = "SELECT * FROM deliver_has_product WHERE deliver_id = ?";
            $params2 = [$row['id']];
            $result2 = $this->database->executarSQL($query2, $params2);
            
            $productId = new Product($result2[0]['product_id']);
            $product = $mProduct->getById($productId);
            $row['product'] = $product;
            $row['quantity'] = $result2[0]['quantity'];
            
            $deliverObj = $this->createDeliverFromData($row);
            $delivers[] = $deliverObj;
        }
        
        return $delivers;
    }


    public function existsDeliverByPayerIdAndToken($payerID, $token) {
        $query = "SELECT * FROM deliver WHERE payerID = ? AND token = ?";
        $params = [$payerID, $token];
        $result = $this->database->executarSQL($query, $params);
        return !empty($result);
    }

    public function createDeliver($deliver) {
        $query = "INSERT INTO deliver (client_id, date, date_deliver) VALUES (?, ?, ?)";
        $params = array(
            $deliver->client_id,
            $deliver->date,
            $deliver->date_deliver
        );
        $this->database->executarSQL($query, $params);
    
        $lastDeliver = $this->getLastInsertedIdByClient($deliver->client_id);
    
        $query2 = "INSERT INTO deliver_has_product (deliver_id, product_id, quantity) VALUES (?, ?, ?)";
        $params2 = array(
            $lastDeliver->id,
            $deliver->product->id,
            $deliver->quantity
        );
        $this->database->executarSQL($query2, $params2);
    
        return $lastDeliver->id;
    }

    public function getDeliverByClientAndToken($obj) {
        $query = "SELECT * FROM deliver WHERE client_id = ? AND token = ?";
        $params = [$obj->client_id, $obj->token];
        $result = $this->database->executarSQL($query, $params);
        
        $delivers = [];
        
        $mProduct = new ProductModel();
        
        foreach ($result as $row) {
            
            $query2 = "SELECT * FROM deliver_has_product WHERE deliver_id = ?";
            $params2 = [$row['id']];
            $result2 = $this->database->executarSQL($query2, $params2);
            
            $productId = new Product($result2[0]['product_id']);
            $product = $mProduct->getById($productId);
            $row['product'] = $product;
            $row['quantity'] = $result2[0]['quantity'];
            
            $deliverObj = $this->createDeliverFromData($row);
            $delivers[] = $deliverObj;
        }
        
        return $delivers;
    } 
    
    public function getLastInsertedIdByClient($clientId) {
        $query = "SELECT * FROM deliver WHERE client_id = ? ORDER BY id DESC LIMIT 1";
        $params = [$clientId];
        
        $result = $this->database->executarSQL($query, $params);
        
        return $this->createDeliverFromData($result[0]);
    }

    public function getDeliversByClient($client_id) {
        $query = "SELECT * FROM deliver WHERE client_id = ?";
        $params = [$client_id];
        $result = $this->database->executarSQL($query, $params);

        $delivers = [];

        $mProduct = new ProductModel();
        
        foreach ($result as $row) {

            $query2 = "SELECT * FROM deliver_has_product WHERE deliver_id = ?";
            $params2 = [$row['id']];
            $result2 = $this->database->executarSQL($query2, $params2);

            $productId = new Product($result2[0]['product_id']);
            $product = $mProduct->getById($productId);
            $row['product'] = $product;
            $row['quantity'] = $result2[0]['quantity'];
            
            $deliverObj = $this->createDeliverFromData($row);
            $delivers[] = $deliverObj;
        }

        return $delivers;
    }

    public function createDeliverFromData($data) {
        return new Deliver(
            $data['id'],
            $data['client_id'],
            $data['date'],
            $data['date_deliver'],
            $data['product'],
            $data['quantity']
        );
    }

}