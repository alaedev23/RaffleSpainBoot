<?php

class ClientDatesView extends View
{

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : null;
    }

    public function show($lang, $errors = null)
    {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        
        ($errors !== null) ? var_dump($errors) : '';

        $htmlDetallesCuentas = $this->generateTemplate();
        $htmlChangePassword = $this->generateEditPassword();

        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/ClientDates.tmp.php";
        echo "</main>";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public function generateTemplate() {
        $template = '<div id="containerDetallesCuenta">
        <form id="clientDetailsForm" action="?client/updateDatesClient/' . $this->user->id . '" method="post">';
        $template .= '<div class="mitad">
        <div class="itemDetalleCuenta">
            <h4>Nombre</h4>
            <input class="inputClientDates" name="name" type="text" value="' . $this->user->name . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Apellidos</h4>
            <input class="inputClientDates" name="surname" type="text" value="' . $this->user->surnames . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Correo electrónico</h4>
            <input class="inputClientDates" name="email" type="text" value="' . $this->user->email . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Número de teléfono</h4>
            <input class="inputClientDates" name="phone" type="text" value="' . $this->user->phone . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Fecha de Nacimiento</h4>
            <input class="inputClientDates" name="born" type="date" value="' . $this->user->born . '">
        </div>';

        $gender = Functions::generateSex($this->user->sex);

        $template .= '<div class="itemDetalleCuenta">
            <label for="sex">Sexo:</label>
            <select name="sex">
                <option value="H" ' . (($gender === "Hombre") ? "selected" : "") . '>Hombre</option>
                <option value="M" ' . (($gender === "Mujer") ? "selected" : "") . '>Mujer</option>
                <option value="O" ' . (($gender === "Otr@") ? "selected" : "") . '>Otr@</option>
            </select>
        </div>';
        
        $template .= '<button type="submit" name="updateDates" class="btn">Guardar Cambios</button></form></div>';

        $template .= '</div>';

        return $template;
    }

    public function generateEditPassword() {
        $passwordEncryp = str_repeat('*', strlen($this->user->password) + 2); // Añado dos elementos mas por seguridad
        
        return '<div><div class="itemDetalleCuenta">
            <h4>Contraseña</h4>
            <div>
                <p>' . $passwordEncryp . '</p>
                <button id="openModalBtn" class="btn">Editar</button>
            </div>
        </div>
            <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header"><h2>Editar contraseña</h2><span id="closeModalBtn" class="close">&times;</span></div>
                <div class="modal-body">
                    <div id="passwordRequirements">
                        <p>1 - Requisitos de la contraseña</p>
                        <p id="lengthRequirement">2 - Mínimo de 8 caracteres</p>
                        <p id="caseRequirement">3 - Letras mayúsculas, minúsculas y un número</p>
                    </div>
                    <form id="editPasswordForm" action="?client/changePassword/' . $this->user->id . '" method="post" style="display: none;">
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
        </div></div>';
    }
}