<?php

class ValidateController extends Controller {
    
    /**
     * Constructor de la clase ValidateController.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Muestra la vista para validar un correo electrónico.
     *
     * @param string $email El correo electrónico a validar.
     * @return void
     */
    public static function show($email) {
        ValidateView::show($email);
    }

    /**
     * Redirige a la página de inicio después de validar un correo electrónico correctamente.
     *
     * @param string $email El correo electrónico validado correctamente.
     * @return void
     */
    public static function showCorrectValidate($email) {
        header("Location: index.php");
        // ValidateView::showCorrectValidate($email);
    }
}
