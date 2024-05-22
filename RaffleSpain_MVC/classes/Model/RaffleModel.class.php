<?php

/**
 * La clase RaffleModel implementa la interfaz Crudable para operaciones CRUD en raffles.
 */
class RaffleModel implements Crudable
{

    /**
     * @var DataBase Instancia de la clase DataBase para interactuar con la base de datos.
     */
    private $database;

    /**
     * Constructor de la clase RaffleModel.
     */
    public function __construct()
    {
        $this->database = new DataBase('select');
    }

    /**
     * Lee todos los registros de raffles de la base de datos.
     *
     * @return array Un array de objetos Raffle.
     */
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
    
    /**
     * Lee un número específico de raffles de forma aleatoria de la base de datos.
     *
     * @param int $quantity Cantidad de raffles a leer.
     * @return array Un array de objetos Raffle.
     * @throws Exception Cuando no hay suficientes elementos disponibles para seleccionar.
     */
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

    /**
     * Obtiene un raffle por su identificador de producto.
     *
     * @param mixed $obj Objeto con el identificador del producto.
     * @return Raffle|null El objeto Raffle encontrado o null si no se encuentra.
     */
    public function getRaffleByProductId($obj) {
        $sql = 'SELECT * FROM raffle WHERE product_id = ? AND winner IS NOT NULL';
        $params = [
            $obj->product->id
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        if (empty($result)) {
            return null;
        }
        
        return $this->createRaffleFromData($result[0]);
    }

    /**
     * Crea un nuevo registro de rifa en la base de datos.
     *
     * @param mixed $obj Objeto Raffle a crear.
     * @return mixed El resultado de la operación SQL.
     */
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
    
    /**
     * Actualiza un registro de rifa en la base de datos.
     *
     * @param mixed $obj Objeto Raffle a actualizar.
     * @return mixed El resultado de la operación SQL.
     */
    public function update($obj)
    {
        $sql = 'UPDATE raffle SET product_id = ?, date_start = ?, date_end = ?, winner = ?, type = ? WHERE id = ?';
        $params = [
            $obj->product_id,
            $obj->date_start,
            $obj->date_end,
            $obj->winner,
            $obj->type,
            $obj->id
        ];

        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Actualiza el ganador de una rifa en la base de datos.
     *
     * @param mixed $obj Objeto Raffle con el ganador actualizado.
     * @return mixed El resultado de la operación SQL.
     */
    public function updateWinner($obj)
    {
        $sql = 'UPDATE raffle SET winner = ? WHERE id = ?';
        $params = [
            $obj->winner,
            $obj->id
        ];
        
        return $this->database->executarSQL($sql, $params);
    }

    /**
     * Agrega un usuario a una rifa en la base de datos.
     *
     * @param mixed $obj Objeto Raffle con el usuario a agregar.
     * @return mixed El resultado de la operación SQL.
     */
    public function addUser($obj)
    {
        $sql = 'INSERT raffle_has_client SET raffle_id = ?, client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];

        return $this->database->executarSQL($sql, $params);
    }

    /**
     * Elimina un usuario de una rifa en la base de datos.
     *
     * @param mixed $obj Objeto Raffle con el usuario a eliminar.
     * @return mixed El resultado de la operación SQL.
     */
    public function removeUser($obj)
    {
        $sql = 'DELETE FROM raffle_has_client WHERE raffle_id = ? AND client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];
        
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Verifica si un usuario está inscrito en una rifa.
     *
     * @param mixed $obj Objeto Raffle con el usuario a verificar.
     * @return bool True si el usuario está en la rifa, False de lo contrario.
     */
    public function userIsInRaffle($obj)
    {
        $sql = 'SELECT * FROM raffle_has_client WHERE raffle_id = ? AND client_id = ?';
        $params = [
            $obj->id,
            $obj->client_id
        ];
        $result = $this->database->executarSQL($sql, $params);
        
        return !empty($result);
    }
    
    /**
     * Elimina un registro de rifa de la base de datos.
     *
     * @param mixed $obj Objeto Raffle a eliminar.
     * @return mixed El resultado de la operación SQL.
     */
    public function delete($obj)
    {
        $sql = 'DELETE FROM raffle WHERE id=?';
        $params = [
            $obj->id
        ];
        
        return $this->database->executarSQL($sql, $params);
    }
    
    /**
     * Busca rifas en la base de datos que coincidan con una cadena de búsqueda.
     *
     * @param string $searchString La cadena de búsqueda.
     * @return array Un array de objetos Raffle que coinciden con la búsqueda.
     */
    public function searchRaffle($searchString)
    {
        $allRaffles = $this->read();
        $searchReady = strtolower($searchString);
        $raffleFound = [];
        
        if (!empty($allRaffles)) {
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
    
    /**
     * Obtiene las rifas asociadas a un cliente.
     *
     * @param int $idClient El ID del cliente.
     * @return array Un array de objetos Raffle asociados al cliente.
     */
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

    /**
     * Obtiene un objeto Raffle por su ID.
     *
     * @param mixed $obj Objeto Raffle con el ID a buscar.
     * @return Raffle|null El objeto Raffle encontrado o null si no se encuentra.
     */
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
    
    /**
     * Obtiene todas las rifas ganadas por un cliente.
     *
     * @param int $idClient El ID del cliente.
     * @return array Un array de objetos Raffle ganadas por el cliente.
     */
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
    
    /**
     * Busca el ganador de una rifa por su ID. Si no hay ganador, genera uno.
     *
     * @param mixed $obj Objeto Raffle con el ID de la rifa.
     * @return mixed El objeto Raffle ganador.
     */
    public function searchWinner($obj)
    {
        $raffle = $this->getById($obj);
        if ($raffle->winner !== null) {
            return $raffle;
        } else {
            $this->generateWinner($obj);
        }
    }
    
    /**
     * Genera un ganador aleatorio para una rifa y lo actualiza en la base de datos.
     *
     * @param mixed $obj Objeto Raffle con el ID de la rifa.
     * @return mixed El resultado de la actualización en la base de datos.
     */
    public function generateWinner($obj) {
        $clientes = $this->getAllClientInRaffle($obj);
        
        if (empty($clientes)) {
            return null;
        }
        
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
    
    /**
     * Obtiene todos los clientes participantes en una rifa.
     *
     * @param mixed $obj Objeto Raffle con el ID de la rifa.
     * @return array Un array de objetos Client que participan en la rifa.
     */
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

    /**
     * Obtiene una rifa de la base de datos por su tipo.
     *
     * @param mixed $obj Objeto con el tipo de rifa a buscar.
     * @return Raffle|null La rifa encontrada o null si no se encuentra.
     */
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
    
    /**
     * Elimina duplicados de un conjunto de resultados de rifas.
     *
     * @param array $results El conjunto de resultados de rifas.
     * @return array El conjunto de resultados de rifas sin duplicados.
     */
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
    
    /**
     * Convierte un objeto Raffle en un array asociativo.
     *
     * @param Raffle $raffle El objeto Raffle a convertir.
     * @return array El array asociativo con los datos de la rifa.
     */
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
    
    /**
     * Crea un objeto Raffle a partir de un array de datos.
     *
     * @param array $data El array de datos de la rifa.
     * @return Raffle El objeto Raffle creado.
     */
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
