<?php

class DeliverController extends Controller {

    private $view;
    public function __construct() {
        parent::__construct();
        $this->view = new DeliverView();
    }

    public function showDelivers($errors = '') {
        if (!isset($_SESSION['usuari'])) {
            throw new Exception("No hi ha cap client loguejat");
        }

        $client_id = $_SESSION['usuari']->id;
        $deliverModel = new DeliverModel();
        $delivers = $deliverModel->getDeliversByClient($client_id);
        
        $this->view->show($delivers, $errors);
    }

}