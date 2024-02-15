<?php

class RaffleController extends Controller {
    
    private Raffle $raffle;
    
    public function __construct() {
        $this->raffle = new Raffle(null, null, null, null);
    }
    
    public function showRaffle($id) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }

        $this->raffle->id = $id[0];

        $mRifa = new RaffleModel();
        $this->raffle = $mRifa->getById($this->raffle);
        
        RaffleView::show($this->raffle, $lang);
    }
    
   
    
}