<?php

class AdminController extends Controller {
    
    public function showAdminPage() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        AdminView::show($lang);
    }
    
}