
<?php

class DeliverModel {

    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function getDeliver($id) {
        $query = "SELECT * FROM deliver WHERE id = :id";
        $params = array(
            ':id' => $id
        );
        $deliver = $this->database->executarSQL($query, $params);

        return $this->createDeliverFromData($deliver[0]);

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