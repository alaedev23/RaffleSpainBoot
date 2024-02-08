<?php

class RaffleController extends Controller {
    
    private $raffle;
    
    public function __construct() {
        $this->raffle = new Raffle(null, null, null, null);
    }
    
    public function showRaffle() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        RaffleView::showLogin($this->raffle, $lang);
    }
    
   
    
}