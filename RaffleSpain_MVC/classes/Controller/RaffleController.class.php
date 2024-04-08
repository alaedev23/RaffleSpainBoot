<?php

class RaffleController extends Controller {
    
    private Raffle $raffle;
    private RaffleModel $mRaffle;
    
    public function __construct() {
        $this->raffle = new Raffle(null, null, null, null);
        $this->mRaffle = new RaffleModel();
    }
    
    public function showRaffle($id) {
        $this->raffle->id = $id[0];
        
        $isIn = false;
        if(isset($_SESSION['usuari'])){
            $obj = new stdClass();
            $obj->id = $this->raffle->id;
            $obj->client_id = $_SESSION['usuari']->id;

            $isIn = false;
            if ($this->mRaffle->userIsInRaffle($obj)) {
                $isIn = true;
            }
        }

        $this->raffle = $this->mRaffle->getById($this->raffle);
        
        RaffleView::show($this->raffle, $isIn);
    }
    
    public function toggleUser($ids) {
        $obj = new stdClass();
        $obj->id = $ids[0];
        $obj->client_id = $ids[1];
    
        if ($this->mRaffle->userIsInRaffle($obj)) {
            $this->mRaffle->removeUser($obj);
        } else {
            $this->mRaffle->addUser($obj);
        }
    
        $this->showRaffle($obj->id);
    
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $url .= ('?Raffle/showRaffle/' . $obj->id);
        echo "<script>history.pushState(null, null, '$url');</script>";
    }
}
