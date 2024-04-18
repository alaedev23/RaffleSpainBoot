<?php

class HomeController extends Controller {
    
    public static function show() {
        
        $mProducts = new ProductModel();
        $products = $mProducts->getRandomProducts(6);

        $mRifa = new RaffleModel();
        $rifas = $mRifa->read();

        HomeView::show($products, $rifas);    
        
    }

}

