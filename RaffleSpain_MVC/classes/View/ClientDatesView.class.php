<?php

class ClientDatesView extends View
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function show($lang, $errors = null)
    {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        $this->user = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : null;

        $htmlDetalleCuenta = $this->generateTemplate($errors);
        $htmlChangePassword = $this->generateEditPassword($errors);
        $htmlChangeDirection = $this->generateDirection($errors);

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

    public function showMyRaffle($lang, $raffles, $errors = null)
    {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";

        $templateMyRaffle = Functions::generatecardRaffle($raffles);

        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/MyRaffles.tmp.php";
        echo "</main>";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
    public function showMyPrizes($lang, $raffles, $errors = null)
    {
        $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        $templateMyPrizes = Functions::generatecardProduct($raffles);
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        echo '<main>';
        include "templates/MyPrizes.tmp.php";
        echo "</main>";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public function generateTemplate($errors = null)
    {
        if ($errors['message'] !== null && $errors['type'] === 1) {
            $errorSection = $errors;
        }

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

        if (isset($errorSection)) {
            $template .= "<div class=\"errorMessage\"><p>" . $errorSection['message'] . "</hp></div>";
        }

        $template .= '<button type="submit" name="updateDates" class="btn">Guardar Cambios</button></form></div>';

        $template .= '</div>';

        return $template;
    }

    public function generateDirection($errors = null)
    {
        if ($errors['message'] !== null && $errors['type'] === 2) {
            $errorSection = $errors;
        }
        
        $template = '<div id="containerDetallesCuenta">
        <form id="clientDetailsForm" action="?client/updateDirection/' . $this->user->id . '" method="post">';
        $template .= '<div class="mitad">
        <div class="itemDetalleCuenta">
            <h4>Poblacion</h4>
            <input class="inputClientDates" name="poblation" type="text" value="' . $this->user->poblation . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Direccion</h4>
            <input class="inputClientDates" name="address" type="text" value="' . $this->user->address . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Planta</h4>
            <input class="inputClientDates" name="floor" type="text" value="' . $this->user->floor . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Puerta</h4>
            <input class="inputClientDates" name="door" type="text" value="' . $this->user->door . '">
        </div>
        <div class="itemDetalleCuenta">
            <h4>Codigo Postal</h4>
            <input class="inputClientDates" name="postal_code" type="text" value="' . $this->user->postal_code . '">
        </div>';

        if (isset($errorSection)) {
            $template .= "<div class=\"errorMessage\"><p>" . $errorSection['message'] . "</hp></div>";
        }

        $template .= '<button type="submit" name="updateDirection" class="btn">Guardar Cambios</button></form></div></div>';

        return $template;
    }

    public function generateEditPassword($errors = null)
    {
        if ($errors['message'] !== null && $errors['type'] === 3) {
            $errorSection = $errors;
        }
        
        $passwordEncryp = str_repeat('*', strlen($this->user->password) + 2); // Añado dos elementos mas por seguridad

        $html = '<div><div class="itemDetalleCuenta">
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
                        </div>';
        
        if (isset($errorSection)) {
            $html .= "<div class=\"errorMessage\"><p>" . $errorSection['message'] . "</hp></div>";
        }
        
        $html .= '<div>
                            <button class="btn" name="changePassword" type="submit">Cambiar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div></div>';

        return $html;
    }
}