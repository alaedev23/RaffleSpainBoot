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
        
        ClientView::showLogin($this->client, $lang);
    }
    
    public function formRegister() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        ClientView::showLogin($this->client, $lang);
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
            
            if (strlen($usuari) == 0) {
                $errors = "El email es obligatorio.";
            }
            else if (!filter_var($usuari, FILTER_VALIDATE_EMAIL)) {
                $errors = "El formato del email es invalido.";
            }
            
            if (strlen($contrasenya) == 0) {
                $errors = "El campo 'contrasenya' es obligatorio.";
            }
            
            $this->client = new Client(
                null,
                null,
                $contrasenya,
                null,
                null,
                $usuari,
                null
            );
            
            $vLogin = new ClientView();
            
            if (!isset($errors)) {
                var_dump($this->client);
                $cLogin = new ClientModel();
                $consulta = $cLogin->getById($this->client);
                if (isset($consulta->name)) {
                    $_SESSION['usuari'] = $consulta;
                    var_dump($consulta);
                    header("Location: index.php");
                }
                else {
                    $errors = "El login es incorrecto";
                    $vLogin->showLogin($this->client, $lang, $errors);
                }
            }
            else {
                $vLogin->showLogin($this->client, $lang, $errors);
            }
        }
    }
    
    public function modificarDatos() {
        header("Location: index.php");
    }
    
}