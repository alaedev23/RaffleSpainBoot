<?php

class ClientController {
    
    private $client;
    
    public function __construct() {
        $this->client = new Client("", "", "", "", "", "", "");
    }
    
}