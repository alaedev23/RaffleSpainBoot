
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

    public function createDeliver($deliver) {
        $query = "INSERT INTO deliver (client_id, date, date_deliver) VALUES (?, ?, ?)";
        $params = array(
            $deliver->client_id,
            $deliver->date,
            $deliver->date_deliver
        );
        $this->database->executarSQL($query, $params);
    
        $result = $this->getIdByClientAndDate($deliver->client_id, $deliver->date_deliver);
        $deliver_id = $result[0]['id'];
        
        
    
        $query2 = "INSERT INTO deliver_has_product (deliver_id, product_id, quantity) VALUES (?, ?, ?)";
        $params2 = array(
            $deliver_id,
            $deliver->product->id,
            $deliver->quantity
        );
        $this->database->executarSQL($query2, $params2);
    
        return $deliver_id;
    }
    
    public function getLastInsertedIdByClient($clientId) {
        $query = "SELECT * FROM deliver WHERE client_id = ? ORDER BY client_id DESC LIMIT 1";
        $params = [$clientId];
        
        $result = $this->database->executarSQL($query, $params);
        
        return $this->createDeliverFromData($result);
    }
    
    public function getIdByClientAndDate($client_id, $date_deliver) {
        $query = "SELECT * FROM deliver WHERE client_id = ? AND DATE(date_deliver) = ?";
        $params = array(
            $client_id,
            $date_deliver
        );
        $result = $this->database->executarSQL($query, $params);
    
        return $result;
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