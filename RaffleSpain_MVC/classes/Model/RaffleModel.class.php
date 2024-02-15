
<?php
class RaffleModel implements Crudable
{
    private $database;

    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    public function read() {
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

    public function create($obj)
    {
        
        $sql = 'INSERT INTO raffle (product_id, date_start, date_end) VALUES (?, ?, ?)';
        $params = [$obj->product_id, $obj->date_start, $obj->date_end];
        
        return $this->database->executarSQL($sql, $params);
    }

    public function update($obj)
    {
        $sql = 'UPDATE raffle SET product_id = ?, date_start = ?, date_end = ? WHERE id=?';
        $params = [$obj->product_id, $obj->date_start, $obj->date_end, $obj->id];
        
        $this->database->executarSQL($sql, $params);
    }

    public function delete($obj)
    {
        $sql = 'DELETE FROM raffle WHERE id=?';
        $params = [$obj->id];
        
        $this->database->executarSQL($sql, $params);
        return $obj;
    }

    public function getById($obj)
    {
        $sql = 'SELECT * FROM raffle WHERE id=? LIMIT 1';
        $params = [$obj->id];
        $result = $this->database->executarSQL($sql, $params);

        if (empty($result)) {
            return null;
        }

        $mProduct = new ProductModel();
        
        $Product = new Product($result[0]['product_id']);
        $consulta = $mProduct->getById($Product);

        $result[0]['product'] = $consulta;

        return $this->createRaffleFromData($result[0]);
    }
    
    private function createRaffleFromData($data)
    {
        return new Raffle(
            $data['id'],
            $data['product_id'],
            $data['date_start'],
            $data['date_end'],
            $data['product'],
            $data['winner']
            );
    }

}
