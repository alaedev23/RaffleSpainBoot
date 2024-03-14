<?php

class ClientDatesView extends View {
    
    private $user;
    
    public function __construct() {
        parent::__construct();
        $this->user = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : null;
    }
    
    public function show($lang, $errors=null) {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        $htmlDetallesCuentas = $this->generateTemplate();
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo '<main style="height: calc(100vh - 242px);">';
        include "templates/ClientDates.tmp.php";
        echo "</main>";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
    public function generateTemplate() {
        $template = '<div id="containerDetallesCuenta"><div class="mitad">
        <div class="itemDetalleCuenta">
            <h4>Nombre</h4>
            <input class="inputClientDates" type="text" value="' . $this->user->name . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Apellidos</h4>
            <input class="inputClientDates" type="text" value="' . $this->user->surnames . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Correo electrónico</h4>
            <input class="inputClientDates" type="text" value="' . $this->user->email . '">
        </div></div>';
        
        $passwordEncryp = str_repeat('*', strlen($this->user->password) + 2); // Añado dos elementos mas por seguridad
        
        $template .= '<div class="mitad">
        <div class="itemDetalleCuenta">
            <h4>Contraseña</h4>
            <div>
                <p>' . $passwordEncryp . '</p>
                <button id="openModalBtn" class="btn">Editar</button>
            </div>
        </div>';
        
        $template .= $this->generateEditPassword();
        
        $template .= '
        <div class="itemDetalleCuenta">
            <h4>Número de teléfono</h4>
            <input class="inputClientDates" type="text" value="' . $this->user->phone . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Fecha de Nacimiento</h4>
            <input class="inputClientDates" type="text" value="' . $this->user->born . '">
        </div></div></div>';
        
        return $template;
    }
    
    
    public function generateEditPassword() {
        return '<div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header"><h2>Editar contraseña</h2><span id="closeModalBtn" class="close">&times;</span></div>
                <div class="modal-body">
                    <div id="passwordRequirements">
                        <p>1 - Requisitos de la contraseña</p>
                        <p id="lengthRequirement">2 - Mínimo de 8 caracteres</p>
                        <p id="caseRequirement">3 - Letras mayúsculas, minúsculas y un número</p>
                    </div>
                    <form id="editPasswordForm" action="?client/changePassword/'. $this->user->id .'" method="post" style="display: none;">
                        <div>
                            <input type="password" placeholder="Contraseña Actual" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div>
                            <input type="password" placeholder="Nueva Contraseña" id="newPassword" name="newPassword" required>
                        </div>
                        <div>
                            <input type="password" placeholder="Confirmar Contraseña" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <div>
                            <button class="btn" name="changePassword" type="submit">Cambiar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }
    
}