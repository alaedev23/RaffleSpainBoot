<?php

class ClientController extends Controller {
    
    private $client;
    
    public function __construct() {
        $this->client = new Client("", "", "", "", "", "", "");
    }
    
    public function formLogin() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        LoginView::showLogin($this->client, $lang);
    }
    
    public function validateLogin() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]))) {
            
            $usuari = $this->sanitize($_POST['username']);
            $contrasenya = $this->sanitize($_POST['password']);
            
//             if (!filter_var($usuari, FILTER_VALIDATE_EMAIL)) {
//                 $errors['username'] = "El campo 'usuari' es obligatorio.";
//             }
            
//             if (strlen($contrasenya) == 0) {
//                 $errors['password'] = "El campo 'contrasenya' es obligatorio.";
//             }
            
            $this->client = new Client(
                null,
                null,
                $contrasenya,
                null,
                null,
                $usuari,
                null
            );
            
            $vLogin = new LoginView();
            
            if (!isset($errors)) {
                var_dump($this->client);
                $cLogin = new ClientModel();
                $consulta = $cLogin->getById($this->client);
                if (isset($consulta->password)) {
                    $_SESSION['usuari'] = $consulta;
                    var_dump($consulta);
                    header("Location: index.php");
                }
                else {
                    $errors['loginIncorrecto'] = "El login es incorrecto";
                    $vLogin->showLogin($this->client, $lang, $errors);
                }
            }
            else {
                $errors['hayerrores'] = "Esta mal la modificacion";
                $vLogin->showLogin($this->client, $lang, $errors);
            }
        }
    }
    
}