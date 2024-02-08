<?php

class ClientController extends Controller {
    
    private $login;
    private $register;
    
    public function __construct() {
        $this->login = new Client("", "", "", "", "", "", "", "", "", "");
        $this->register = new Client("", "", "", "", "", "", "", "", "", "");
    }
    
    public function formLogin() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        ClientView::showLogin($this->login, $lang);
    }
    
    public function formRegister() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        ClientView::showRegister($this->register, $lang);
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
            
            $this->login = new Client(
                null,
                null,
                $contrasenya,
                null,
                null,
                $usuari,
                null,
                null,
                null,
                null
            );
            
            $vLogin = new ClientView();
            if (!isset($errors)) {
                $cLogin = new ClientModel();
                $consulta = $cLogin->getById($this->login);
                if ($consulta != "El email o la contrasenya no son correctos.") {
                    $_SESSION['usuari'] = $consulta;
                    ($consulta->__get("type") == 1) ? $_SESSION['userAdmin'] = true : $_SESSION['userAdmin'] = false;
                    header("Location: index.php");
                }
                else {
                    $vLogin->showLogin($this->login, $lang, $consulta);
                }
            } else {
                $vLogin->showLogin($this->login, $lang, $errors);
            }
        }
    }
    
    public function validateRegister() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"]))) {
            
            $name = $this->sanitize($_POST['name']);
            $apellidos = $this->sanitize($_POST['surnames']);
            $usuari = $this->sanitize($_POST['username']);
            $contrasenya = $this->sanitize($_POST['password']);
            $nacimiento = $this->sanitize($_POST['born']);
            $telefono = $this->sanitize($_POST['phone']);
            $poblacion = $this->sanitize($_POST['poblation']);
            $direccion = $this->sanitize($_POST['address']);
            $sexo = $this->sanitize($_POST['sex']);
            
            if (strlen($name) == 0) {
                $errors = "El nombre es obligatorio.";
            }
            
            if (strlen($apellidos) == 0) {
                $errors = "Los apellidos son obligatorio.";
            }
            
            if (strlen($usuari) == 0) {
                $errors = "El email es obligatorio.";
            } else if (!filter_var($usuari, FILTER_VALIDATE_EMAIL)) {
                $errors = "El formato del email es invalido.";
            }
            
            if (strlen($contrasenya) == 0) {
                $errors = "La contrasenya es obligatorio.";
            }
            
            if (strlen($nacimiento) > 0) {
                $objFecha = DateTime::createFromFormat('Y-m-d', $nacimiento);
                if (!$objFecha || $objFecha->format('Y-m-d') !== $nacimiento) {
                    $errors = "El formato de la fecha de nacimiento esta mal.";
                }
            }
            
            if (strlen($poblacion) == 0) {
                $errors = "La poblacion es obligatorio.";
            }
            
            if (strlen($direccion) < 0) {
                $errors = "La direccion es obligatorio.";
            } else if (!str_contains($direccion, ",")) {
                $errors = "La direccion esta mal, debe de contener 'direccion', 'numero'.";
            }
            
            $this->register = new Client(
                null,
                $name,
                $contrasenya,
                $apellidos,
                $nacimiento,
                $usuari,
                $telefono,
                $sexo,
                $poblacion,
                $direccion
            );
            
            $vLogin = new ClientView();
            
            if (!isset($errors)) {
                $cLogin = new ClientModel();
                $consulta = $cLogin->create($this->register);
                if ($consulta === "La consulta se ha realizado con existo") {
                    header("index.php");
                }
                else {
                    $errors = "El registro es incorrecto";
                    $vLogin->showRegister($this->register, $lang, $errors);
                }
            }
            else {
                $vLogin->showRegister($this->register, $lang, $errors);
            }
        }
    }
    
    public function logOut()
    {
        session_destroy();
        header("Location: index.php");
        
    }
    
    public function modificarDatos() {
        header("Location: index.php");
    }
    
}