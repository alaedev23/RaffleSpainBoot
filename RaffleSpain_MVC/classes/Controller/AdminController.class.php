<?php

class AdminController extends Controller {
    
    private $productsAll;
    private $rafflesAll;
    
    private $products;
    private $raffles;
    
    public function showAdminPage() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $pModel = new ProductModel();
        $this->productsAll = $pModel->read();
        
        $rModel = new RaffleModel();
        $this->rafflesAll = $rModel->read();
        
        AdminView::show($lang, $this->productsAll, $this->rafflesAll);
    }
    
    
    
}