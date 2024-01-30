<?php

class HomeController extends Controller {
    
    public static function show() {
        
        $mProducts = new ProductModel();
        $products = $mProducts->read();

        HomeView::show($products);    
        
    }

}

