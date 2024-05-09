<?php

class HomeController extends Controller {
    
    public static function show() {
        
        $mProducts = new ProductModel();
        $products = $mProducts->getRandomProducts(6);

        $mRifa = new RaffleModel();
        $rifas = $mRifa->readRandomRaffle(3);

        HomeView::show($products, $rifas);    
        
    }

}

