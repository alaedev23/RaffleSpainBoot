<?php

class ValidateController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public static function show($email) {
        ValidateView::show($email);
    }

    public static function showCorrectValidate($email) {
        header("Location: index.php");
        // ValidateView::showCorrectValidate($email);
    }
    
  
}