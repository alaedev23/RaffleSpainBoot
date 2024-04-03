<?php

class RaffleController extends Controller {
    
    private Raffle $raffle;
    
    public function __construct() {
        $this->raffle = new Raffle(null, null, null, null);
    }
    
    public function showRaffle($id) {

        $this->raffle->id = $id[0];

        $mRifa = new RaffleModel();
        $isIn = null;
        if(isset($_SESSION['user'])){
            // Crear un objeto para almacenar los datos del usuario y la rifa
            $obj = new stdClass();
            $obj->id = $id[0];
            $obj->client_id = $_SESSION['user']->id;
            if ($mRifa->userIsInRaffle($obj)) {
                $isIn = true;
            }
        
        }

        $this->raffle = $mRifa->getById($this->raffle);
        
        RaffleView::show($this->raffle, $isIn);
    }
    
    public function toggleUser($ids) {
        // Crear una instancia del modelo de rifa
        $mRaffle = new RaffleModel();
    
        // Crear un objeto para almacenar los datos del usuario y la rifa
        $obj = new stdClass();
        $obj->id = $ids[0];
        $obj->client_id = $ids[1];
    
        $isIn = null;
        if ($mRaffle->userIsInRaffle($obj)) {
            // Si el usuario ya está en la rifa, eliminarlo
            $isIn = true;
            $mRaffle->removeUser($obj);
        } else {
            // Si el usuario no está en la rifa, agregarlo
            $mRaffle->addUser($obj);
        }
    
        // Obtener la rifa por su ID
        $this->raffle = $mRaffle->getById($obj);
    
        // Mostrar la vista de la rifa
        RaffleView::show($this->raffle, $isIn);
    
        // Cambiar la URL en la barra de direcciones sin recargar la página
        $url = $_SERVER['REQUEST_URI']; // Obtener la URL actual
        $url = strtok($url, '?'); // Eliminar cualquier parámetro de consulta existente
        $url .= ('?Raffle/showRaffle/' . $this->raffle->id); // Agregar un parámetro si el usuario está en la rifa
        echo "<script>history.pushState(null, null, '$url');</script>";
    }
    
    
    
}