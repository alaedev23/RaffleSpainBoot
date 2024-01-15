<?php

class ClientController extends Controller {
    
    private $client;
    
    public function __construct() {
        $this->client = new Client("", "", "", "", "", "", "");
    }
    
    public function formLogin() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $vLogin = new LoginView();
        $vLogin->showLogin($this->login, $lang);
    }
    
}