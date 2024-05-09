<?php

class RaffleModel implements Crudable
{

    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function read()
    {
        $sql = 'SELECT * FROM raffle';
        $results = $this->database->executarSQL($sql);

        $mProduct = new ProductModel();

        foreach ($results as $result) {

            $Product = new Product($result['product_id']);
            $consulta = $mProduct->getById($Product);

            $result['product'] = $consulta;
            $raffles[] = $this->createRaffleFromData($result);
        }

        return $raffles;
    }
    
    public function readRandomRaffle($quantity)
    {
        $sql = 'SELECT * FROM raffle';
        $results = $this->database->executarSQL($sql);
        
        $totalRaffles = count($results);
        if ($totalRaffles < $quantity) {
            throw new Exception("No hay suficientes elementos disponibles para seleccionar.");
        }
        
        $randomRaffles = [];
        $selectedIndexes = [];
        
        while (count($randomRaffles) < $quantity) {
            $randomIndex = mt_rand(0, $totalRaffles - 1);
            
            if (!in_array($randomIndex, $selectedIndexes)) {
                $randomRaffles[] = $results[$randomIndex];
                $selectedIndexes[] = $randomIndex;
            }
        }
        
        $mProduct = new ProductModel();
        $finalResult = [];
        
        foreach ($randomRaffles as $rifa) {
            $objRaffle = $this->createRaffleFromData($rifa);
            $objRaffle->product = $mProduct->getById(new Product($objRaffle->product_id));
            $finalResult[] = $objRaffle;
        }
        
        return $finalResult;
    }

    public function getRaffleByProductId($obj) {
        $sql = 'SELECT * FROM raffle WHERE product_id = ? AND winner IS NOT NULL';
        $params = [
            $obj->product_id
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        return $this->createRaffleFromData($result[0]);
    }

    public function create($obj)
    {
        $sql = 'INSERT INTO raffle (product_id, date_start, date_end, type) VALUES (?, ?, ?, ?)';
        $params = [
            $obj->product_id,
            $obj->date_start,
            $obj->date_end,
            $obj->type
        ];

        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE raffle SET product_id = ?, date_start = ?, date_end = ?, type = ? WHERE id = ?';
        $params = [
            $obj->product_id,
            $obj->date_start,
            $obj->date_end,
            $obj->type,
            $obj->id
        ];

        return $this->database->executarSQL($sql, $params);
    }
    
    public function updateWinner($obj)
    {
        $sql = 'UPDATE raffle SET winner = ? WHERE id = ?';
        $params = [
            $obj->winner,
            $obj->id
        ];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function addUser($obj)
    {
        $sql = 'INSERT raffle_has_client SET raffle_id = ?, client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];

        return $this->database->executarSQL($sql, $params);
    }

    public function removeUser($obj)
    {
        $sql = 'DELETE FROM raffle_has_client WHERE raffle_id = ? AND client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];

        return $this->database->executarSQL($sql, $params);
    }

    public function userIsInRaffle($obj)
    {
        $sql = 'SELECT * FROM raffle_has_client WHERE raffle_id = ? AND client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];
        $result = $this->database->executarSQL($sql, $params);

        return ! empty($result);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM raffle WHERE id=?';
        $params = [
            $obj->id
        ];

        return $this->database->executarSQL($sql, $params);
        ;
    }

    public function searchRaffle($searchString)
    {
        $allRaffles = $this->read();
        $searchReady = strtolower($searchString);
        $raffleFound = [];

        if (! empty($allRaffles)) {
            foreach ($allRaffles as $raffle) {
                $mProduct = new ProductModel();
                $product = $mProduct->getById(new Product($raffle->__get("product_id")));
                $nameBrand = strtolower($product->__get("brand")) . " " . strtolower($product->__get("name"));
                if (str_contains(strtolower($product->__get("name")), $searchReady) || str_contains(strtolower($product->__get("brand")), $searchReady) || str_contains(strtolower($product->__get("color")), strtolower($searchString)) || str_contains($nameBrand, strtolower($searchString))) {
                    array_push($raffleFound, $raffle);
                }
            }
        }

        return $raffleFound;
    }

    public function getRaffleForClient($idClient)
    {
        $sql = 'SELECT * FROM raffle_has_client WHERE client_id = ?';
        $params = [$idClient];
        $query = $this->database->executarSQL($sql, $params);
        
        if (empty($query)) {
            return null;
        }
        
        $result = [];
        foreach ($query as $element) {
            $objRaffle = new Raffle();
            $objRaffle->__set("id", $element['raffle_id']);
            $result[] = $this->getById($objRaffle);
        }
        
        return $result;
    }
    

    public function getById($obj)
    {        
        $sql = 'SELECT * FROM raffle WHERE id=? LIMIT 1';
        $params = [
            $obj->id
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }

        $mProduct = new ProductModel();

        $product_id = new Product($result[0]['product_id']);
        $consulta = $mProduct->getById($product_id);
        
        $result[0]['product'] = $consulta;
        
        return $this->createRaffleFromData($result[0]);
    }
    
    public function getWinnerByClientId($idClient)
    {
        $sql = 'SELECT * FROM raffle WHERE winner = ?';
        $params = [$idClient];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        $resultsReturn = [];
        
        foreach ($result as $index => $value) {
            $mProduct = new ProductModel();
            
            $product_id = new Product($result[$index]['product_id']);
            $consulta = $mProduct->getById($product_id);
            
            $result[$index]['product'] = $consulta;
            $resultsReturn[] = $this->createRaffleFromData($result[$index]);
        }
        
        return $resultsReturn; 
    }
    
//     public function getWinnerByClientId($obj)
//     {
//         $sql = 'SELECT * FROM raffle_has_client WHERE client_id = ?';
//         $params = [
//             $obj->id
//         ];
//         $result = $this->database->executarSQL($sql, $params);
        
//         if (empty($result)) {
//             return null;
//         }
        
//         $clients = [];
//         $mClient = new ClientModel();
//         foreach ($result as $element) {
//             $newClient = $mClient->getById(new Client($element['client_id']));
//             $clients[] = $newClient;
//         }
        
//         return $clients;
//     }
    
    public function searchWinner($obj)
    {
        $raffle = $this->getById($obj);
        if ($raffle->winner !== null) {
            return $raffle;
        } else {
            $this->generateWinner($obj);
        }
    }
    
    public function generateWinner($obj) {
        $clientes = $this->getAllClientInRaffle($obj);
        
        $ids = [];
        foreach ($clientes as $client) {
            $ids[] = $client->id;
        }
        
        $randomId = $ids[array_rand($ids)];
        
        $mClient = new ClientModel();
        $clientSelected = $mClient->getById(new Client($randomId));
        
        $obj->winner = $clientSelected->id;       
        $update = $this->updateWinner($obj);
        
        return $update;
    }
    
    public function getAllClientInRaffle($obj)
    {
        $sql = 'SELECT * FROM raffle_has_client WHERE raffle_id = ?';
        $params = [
            $obj->id
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        $clients = [];
        $mClient = new ClientModel();
        foreach ($result as $element) {
            $newClient = $mClient->getById(new Client($element['client_id']));
            $clients[] = $newClient;
        }
        
        return $clients;
    }

    public function getByType($obj)
    {
        $sql = 'SELECT * FROM raffle WHERE type=?';
        $params = [
            $obj->type
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        
        return $this->createRaffleFromData($result[0]); 
    }

    public function deleteDuplicate($results)
    {
        $resultado = [];
        $modelCodes = [];

        foreach ($results as $result) {
            $dataArray = [];
            if ($result instanceof Raffle) {
                $dataArray = $this->raffleToArray($result);
            } else {
                $dataArray = $result;
            }

            $raffle = $this->createRaffleFromData($dataArray);
            $currentId = $raffle->__get("id");

            if (! in_array($currentId, $modelCodes)) {
                $modelCodes[] = $currentId;
                $resultado[] = $raffle;
            }
        }
        return $resultado;
    }

    public function raffleToArray($raffle)
    {
        $mProduct = new ProductModel();
        $arrayProduct = $mProduct->productToArray($raffle->product);
        $objProduct = $mProduct->createProductFromData($arrayProduct);
        $dataArray = [
            "id" => $raffle->id,
            "product_id" => $raffle->product_id,
            "date_start" => $raffle->date_start,
            "date_end" => $raffle->date_end,
            "product" => $objProduct,
            "winner" => $raffle->winner,
            "type" => $raffle->type
        ];
        return $dataArray;
    }

    private function createRaffleFromData($data)
    {
        return new Raffle(
            $data['id'], 
            $data['product_id'], 
            date("Y-m-d H:i", strtotime($data['date_start'])), 
            date("Y-m-d H:i", strtotime($data['date_end'])), 
            $data['product'], 
            $data['winner'], 
            $data['type']);
    }
}
