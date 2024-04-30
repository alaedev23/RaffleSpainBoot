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
        $this->login = new Client(null);
        $this->register = new Client(null);
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
            $auxObj = new Client($id);
            $result = $mClient->getById($auxObj);
            
            if ($result->password !== $currentPassword) {
                $errors = ["message" => "La contraseña actual es incorrecta."];
            }
            
            if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/", $newPassword)) {
                $errors = ["message" => "La contraseña no teiene el formato correcto."];
            } else if ($result->password === $newPassword) {
                $errors = ["message" => "No puedes cambiar la contraseña a la que tenias."];
            }
            
            if ($newPassword !== $confirmPassword) {
                $errors = ["message" => "La contrasenya nueva no coincide con la contraseña de confirmacion."];
            }
            
            if (!isset($errors)) {
                
                $result->__set("password", $confirmPassword);
                $consulta = $mClient->updatePassword($result);
                
                if ($consulta === "La consulta se ha realizado con existo") {
                    session_destroy();
                    header("Location: index.php?client/formLogin");
                } else {
                    $this->vClientDates->show($lang, $consulta);
                }
            } else {
                $errors["type"] = 3;
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
                $errors = ["message" => "Error al enviar el id.", "type" => 1];
            }
            
            if (strlen($name) === 0) {
                $errors = ["message" => "El nombre es obligatorio.", "type" => 1];
            }
            
            if (strlen($apellidos) == 0) {
                $errors = ["message" => "Los apellidos son obligatorios.", "type" => 1];
            }
            
            if (strlen($email) == 0) {
                $errors = ["message" => "El email es obligatorio.", "type" => 1];
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors = ["message" => "El formato del email es inválido.", "type" => 1];
            }
            
            if (strlen($nacimiento) > 0) {
                $nacimientoAux = DateTime::createFromFormat('Y-m-d', $nacimiento);
                if (!$nacimientoAux || $nacimientoAux->format('Y-m-d') !== $nacimiento) {
                    $errors = ["message" => "El formato de la fecha de nacimiento está mal.", "type" => 1];
                } else {
                    $nacimiento = $nacimientoAux->format('Y-m-d');
                }
            }
            
            if ($sexo !== "H" && $sexo !== "M" && $sexo !== "O") {
                $errors = ["message" => "El género debe ser hombre, mujer u otro.", "type" => 1];
            }
            
            if (!isset($errors)) {
                $mClient = new ClientModel();
                
                $userOld = $mClient->getById(new Client(intval($id)));
                
                if (!is_string($userOld)) {
                    
                    $updateClient = new Client($id, $name, $userOld->__get("password"), $apellidos, $nacimiento, $email, $telefono, $sexo, $userOld->__get("poblation"), $userOld->__get("address"), $userOld->__get("type"));
                    
                    $consulta = $mClient->update($updateClient);
                    
                    if ($consulta === "La consulta se ha realizado con éxito") {
                        $_SESSION['usuari'] = $updateClient;
                        $this->vClientDates->show($lang);
                    } else {
                        $errors = ["message" => "El registro es incorrecto", "type" => 1];
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
    
    public function updateDirection($idPass) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["updateDirection"]))) {
            
            $poblation = $this->sanitize($_POST['poblation']);
            $address = $this->sanitize($_POST['address']);
            $floor = $this->sanitize($_POST['floor']);
            $door = $this->sanitize($_POST['door']);
            $postal_code = $this->sanitize($_POST['postal_code']);
            
            $id = intval($idPass);
            
            if (!is_numeric($id)) {
                $errors = ["message" => "Error al enviar el id.", "type" => 2];
            }
            
            if (strlen($poblation) > 0) {
                if (!is_string($poblation)) {
                    $errors = ["message" => "La población no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($address) > 0) {
                if (!is_string($address)) {
                    $errors = ["message" => "La dirección no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($floor) > 0) {
                if (!is_numeric($floor)) {
                    $errors = ["message" => "La planta no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($door) > 0) {
                if (!is_numeric($door)) {
                    $errors = ["message" => "La puerta no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($postal_code) > 0) {
                if (!is_numeric($postal_code) || !preg_match('/^[0-9]{5}$/', $postal_code)) {
                    $errors = ["message" => "El código postal no es correcto.", "type" => 2];
                }
            }
            
            if (!isset($errors)) {
                $mClient = new ClientModel();
                
                $userOld = $mClient->getById(new Client($id));
                
                if (!is_string($userOld)) {
                    
                    $updateClient = new Client($id);
                    $updateClient->__set("address", $address);
                    $updateClient->__set("poblation", $poblation);
                    $updateClient->__set("floor", $floor);
                    $updateClient->__set("door", $door);
                    $updateClient->__set("postal_code", $postal_code);
                    
                    $consulta = $mClient->updateDirection($updateClient);
                    
                    if ($consulta === "La consulta se ha realizado con éxito") {
                        $_SESSION['usuari']->address = $address;
                        $_SESSION['usuari']->poblation = $poblation;
                        $_SESSION['usuari']->floor = $floor;
                        $_SESSION['usuari']->door = $door;
                        $_SESSION['usuari']->postal_code = $postal_code;
                        $this->vClientDates->show($lang);
                    } else {
                        $errors = ["message" => "El registro es incorrecto", "type" => 2];
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
            $floor = $this->sanitize($_POST['floor']);
            $door = $this->sanitize($_POST['door']);
            $postal_code = $this->sanitize($_POST['postal_code']);
            
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
            
            if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/", $contrasenya)) {
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
            
            if (strlen($direccion) == 0) {
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
            
            if (strlen($floor) > 0) {
                if (!is_numeric($floor)) {
                    $errors = ["message" => "La planta no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($door) > 0) {
                if (!is_numeric($door)) {
                    $errors = ["message" => "La puerta no es correcta.", "type" => 2];
                }
            }
            
            if (strlen($postal_code) > 0) {
                if (!is_numeric($postal_code) || !preg_match('/^[0-9]{5}$/', $postal_code)) {
                    $errors = ["message" => "El código postal no es correcto.", "type" => 2];
                }
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
                $direccion,
                0,
                $floor,
                $door,
                $postal_code
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