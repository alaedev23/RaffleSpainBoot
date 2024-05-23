<?php

class MapController extends Controller {
    
    /**
     * Muestra el mapa en la vista.
     *
     * @return void
     */
    public function mostrar() {
        MapView::showMap();
    }
    
}
