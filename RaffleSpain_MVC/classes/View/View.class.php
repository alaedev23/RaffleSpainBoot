<?php

/**
 * Clase View
 *
 * La clase View es una clase base para todas las vistas del sistema.
 */
class View {
    
    /**
     * @var string $lang Idioma de la vista.
     */
    public $lang;
    
    /**
     * Constructor de la clase.
     *
     * Establece el idioma de la vista, utilizando el idioma almacenado en la cookie si está disponible,
     * de lo contrario, establece el idioma por defecto en español.
     */
    public function __construct() {
        if (isset($_COOKIE["lang"])) {
            $this->lang = $_COOKIE["lang"];
        } else {
            $this->lang = "es";
        }        
    }
    
}

