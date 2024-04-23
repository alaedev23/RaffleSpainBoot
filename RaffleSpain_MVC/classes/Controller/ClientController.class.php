<?php

require_once 'vendor/autoload.php';
require_once 'classes/Config/Crypto.php';

// Type 0: no validado
// Type 1: validado
// Type 2: admin
// Type 3: miembro

class ClientController extends Controller {
    
    private $login;
    private $register;
    
    private $vClient;
    private $vClientDates;
    public function __construct() {
        $this->login = new Client("", "", "", "", "", "", "", "", "", "");
        $this->register = new Client("", "", "", "", "", "", "", "", "", "");
        $this->vClientDates = new ClientDatesView();
        $this->vClient = new ClientView();
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
    
    public function showDatesClient() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $vClientDates = new ClientDatesView();
        $vClientDates->show($lang);
    }
    
    public function changePassword($idSent) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["changePassword"]))) {
            
            $mClient = new ClientModel();
            
            $currentPassword = $this->sanitize($_POST['currentPassword']);
            $newPassword = $this->sanitize($_POST['newPassword']);
            $confirmPassword = $this->sanitize($_POST['confirmPassword']);
            
            $id = $idSent[0];
            $auxObj = new Client($id, null, null, null, null, null, null, null, null, null);
            $result = $mClient->getById($auxObj);
            
            if ($result->password !== $currentPassword) {
                $errors = "La contraseña actual es incorrecta.";
            }
            
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword)) {
                $errors = "La contraseña no teiene el formato correcto.";
            }
            
            if ($newPassword !== $confirmPassword) {
                $errors = "La contrasenya nueva no coincide con la contraseña de confirmacion.";
            }
            
            if (!isset($errors)) {
                
                $result->__set("password", $confirmPassword);
                $consulta = $mClient->updatePassword($result);
                
                if (count($consulta) === 0) {
                    session_destroy();
                    header("Location: index.php?client/formLogin");
                } else {
                    $this->vClientDates->show($lang, $consulta);
                }
            } else {
                $this->vClientDates->show($lang, $errors);
            }
        }
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
            
            if (!isset($errors)) {
                $mClient = new ClientModel();
                $consulta = $mClient->getByEmailPassword($this->login);
                if ($consulta != "El email o la contrasenya no son correctos.") {
                    // session_regenerate_id();
                    if ($consulta->__get("type") === "0") {
                        $errors = "Usuario no validado. Por favor, revise su correo electrónico.";
                    } else {
                        $_SESSION['usuari'] = $consulta;
                        ($consulta->__get("type") == 2) ? $_SESSION['userAdmin'] = true : $_SESSION['userAdmin'] = false;
                        header("Location: index.php");
                    }

                }
                else {
                    $this->vClient->showLogin($this->login, $lang, $consulta);
                }
            } else {
                $this->vClient->showLogin($this->login, $lang, $errors);
            }
        }
    }
    
    public function updateDatesClient($idPass) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["updateDates"]))) {
            
            $name = $this->sanitize($_POST['name']);
            $apellidos = $this->sanitize($_POST['surname']);
            $email = $this->sanitize($_POST['email']);
            $nacimiento = $this->sanitize($_POST['born']);
            $telefono = $this->sanitize($_POST['phone']);
            $sexo = $this->sanitize($_POST['sex']);
            
            $id = intval($idPass);
            
            if (!is_numeric($id)) {
                $errors = "Error al enviar el id.";
            }
            
            if (strlen($name) === 0) {
                $errors = "El nombre es obligatorio.";
            }
            
            if (strlen($apellidos) == 0) {
                $errors = "Los apellidos son obligatorio.";
            }
            
            if (strlen($email) == 0) {
                $errors = "El email es obligatorio.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors = "El formato del email es invalido.";
            }
            
            if (strlen($nacimiento) > 0) {
                $nacimientoAux = DateTime::createFromFormat('Y-m-d', $nacimiento);
                if (!$nacimientoAux || $nacimientoAux->format('Y-m-d') !== $nacimiento) {
                    $errors = "El formato de la fecha de nacimiento está mal.";
                } else {
                    $nacimiento = $nacimientoAux->format('Y-m-d');
                }
            }
            
            if ($sexo !== "H" && $sexo !== "M" && $sexo !== "O") {
                $errors = "El género debe ser hombre, mujer u otro.";
            }
            
            if (!isset($errors)) {
                $mClient = new ClientModel();
                
                $userOld = $mClient->getById(new Client(intval($id)));
                
                if (!is_string($userOld)) {  
                    
                    $updateClient = new Client(
                        $id,
                        $name,
                        $userOld->__get("password"),
                        $apellidos,
                        $nacimiento,
                        $email,
                        $telefono,
                        $sexo,
                        $userOld->__get("poblation"),
                        $userOld->__get("address"),
                        $userOld->__get("type"),
                    );
                    
                    $consulta = $mClient->update($updateClient);
                    
                    if ($consulta === "La consulta se ha realizado con existo") {
                        $_SESSION['usuari'] = $updateClient;
                        $this->vClientDates->show($lang);
                    } else {
                        $errors = "El registro es incorrecto";
                        $this->vClientDates->show($lang, $errors);
                    }
                } else {
                    
                }
            }
            else {
                $this->vClientDates->show($lang, $errors);
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
            
            $mClient = new ClientModel();
            $consultaEmail = $mClient->getByEmail($usuari);

            if (strlen($usuari) == 0) {
                $errors = "El email es obligatorio.";
            } else if (!filter_var($usuari, FILTER_VALIDATE_EMAIL)) {
                $errors = "El formato del email es invalido.";
            } else if ($consultaEmail !== "No se ha encontrado usuario en el GetByEmail.") {
                $errors = "El email ya existe.";
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
            } 


            $consultaPhone = $mClient->getByPhone($telefono);

            if (strlen($telefono) == 0) {
                $errors = "El telefono es obligatorio.";
            } else if (!preg_match('/^[0-9]{9}$/', $telefono)) {
                $errors = "El telefono no tiene el formato correcto.";
            } else if ($consultaPhone !== false) {
                $errors = "El telefono ya existe.";
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
                        
            if (!isset($errors)) {
                $mClient = new ClientModel();
                $consulta = $mClient->create($this->register);
                
                if ($consulta === "La consulta se ha realizado con existo") {
                    $eController = new EmailController();
                    $eController->sendMail($this->register);
                    ValidateView::show($this->register->email);
                } else {
                    $this->vClient->showRegister($this->register, $lang, $consulta);
                }
            }
            else {
                $this->vClient->showRegister($this->register, $lang, $errors);
            }
        }
    }
    
    public function logOut() {
        session_destroy();
        header("Location: index.php");   
    }
    
}