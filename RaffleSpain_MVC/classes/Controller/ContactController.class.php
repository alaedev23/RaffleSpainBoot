<?php

class ContactController extends Controller {
    
    public function showContactUs() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        ContactView::show($lang);
    }
    
    public function verifyForm() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sendContactUs"])) {
            
            $titulo = $this->sanitize($_POST['tituloContactUs']);
            $mensaje = $this->sanitize($_POST['mensajeContactUs']);
            isset($_POST['emailContactUs']) ? $email = $this->sanitize($_POST['emailContactUs']) : '';
            
            if (strlen($titulo) === 0) {
                $errors = "El título es obligatorio.";
            }
            
            if (strlen($mensaje) === 0) {
                $errors = "El mensaje es obligatorio.";
            }
            
            if (isset($email)) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors = "El formato del email es inválido.";
                }
            }
            
            if (!isset($errors)) {
                $infoClient = [
                    "titulo" => $titulo,
                    "mensaje" => $mensaje,
                ];
                
                (isset($email)) ? $infoClient["email"] = $email : $infoClient["email"] = $_SESSION['usuari']->email;                
                
                $cEmail = new EmailController();
                $cEmail->sendMailContactUs($infoClient);
                
            } else {
                ContactView::show($lang, $errors);
            }
        }
    }
    
    
}