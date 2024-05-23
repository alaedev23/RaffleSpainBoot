<?php

class ClientAdminController extends Controller {
    
    private $clientModel;
    private $clients;

    private $client;


    public function __construct() {
        $this->clientModel = new ClientModel();
    }
    
    /**
     * Muestra todos los clientes en la vista de administración de clientes.
     *
     * @throws Exception Si hay un problema al acceder a los datos de los clientes.
     */
    public function show() {
        
        $this->clients = $this->clientModel->read();
        
        ClientAdminView::showClients("es", $this->clients);

    }
    
        /**
     * Crea un nuevo cliente.
     *
     * @throws Exception Si hay errores de validación al crear el cliente.
     */
    public function createClient() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataCreate"]))) {

            $name = $this->sanitize($_POST["name"]);
            $password = $this->sanitize($_POST["password"]);
            $surnames = $this->sanitize($_POST["surnames"]);
            $born = $this->sanitize($_POST["born"]);
            $email = $this->sanitize($_POST["email"]);
            $phone = $this->sanitize($_POST["phone"]);
            $sex = $this->sanitize($_POST["sex"]);
            $poblation = $this->sanitize($_POST["poblation"]);
            $address = $this->sanitize($_POST["address"]);
            $type = $this->sanitize($_POST["type"]);
            $floor = $this->sanitize($_POST["floor"]);
            $door = $this->sanitize($_POST["door"]);
            $postal_code = $this->sanitize($_POST["postal_code"]);

            if (strlen($name) === 0) {
                $errors .= "El nom no pot estar buit";
            }

            if (strlen($password) === 0) {
                $errors .= "La contrasenya no pot estar buida";
            }

            if (strlen($surnames) === 0) {
                $errors .= "Els cognoms no poden estar buits";
            }

            if (strlen($born) === 0) {
                $errors .= "La data de naixement no pot estar buida";
            }

            if (strlen($email) === 0) {
                $errors .= "El correu electrònic no pot estar buit";
            }

            if (strlen($phone) === 0) {
                $errors .= "El telèfon no pot estar buit";
            }

            if (strlen($sex) === 0) {
                $errors .= "El sexe no pot estar buit";
            }

            if (strlen($poblation) === 0) {
                $errors .= "La població no pot estar buida";
            }

            if (strlen($address) === 0) {
                $errors .= "L'adreça no pot estar buida";
            }

            if (strlen($type) === 0) {
                $errors .= "El tipus no pot estar buit";
            }

            if (strlen($floor) === 0) {
                $errors .= "El pis no pot estar buit";
            }

            if (strlen($door) === 0) {
                $errors .= "La porta no pot estar buida";
            }

            if (strlen($postal_code) === 0) {
                $errors .= "El codi postal no pot estar buit";
            }

            if (!isset($errors)) {
                $this->client = $this->assignClientData(null, $name, $password, $surnames, $born, $email, $phone, $sex, $poblation, $address, $type, $floor, $door, $postal_code);
                $create = $this->clientModel->create($this->client);

                if ($create === "La consulta se ha realizado con existo") {
                    $this->clients = $this->clientModel->read();
                    header("Location: index.php?ClientAdmin/show");
                    ClientAdminView::showClients("es", $this->clients, null);
                } else {
                    $errores = $create;
                    ClientAdminView::showClients("es", $this->clients, $this->client, false, $errores);
                }

            } else {
                ClientAdminView::showClients("es", $this->clients, $errors);
            }

        }

    }
    
    /**
     * Actualiza un cliente existente.
     *
     * @throws Exception Si hay errores de validación al actualizar el cliente o al acceder a los datos del cliente.
     */
    public function updateClientSelected() {
        

        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataUpdate"]))) {

            $id = $this->sanitize($_POST["id"]);
            $name = $this->sanitize($_POST["name"]);
            $password = $this->sanitize($_POST["password"]);
            $surnames = $this->sanitize($_POST["surnames"]);
            $born = $this->sanitize($_POST["born"]);
            $email = $this->sanitize($_POST["email"]);
            $phone = $this->sanitize($_POST["phone"]);
            $sex = $this->sanitize($_POST["sex"]);
            $poblation = $this->sanitize($_POST["poblation"]);
            $address = $this->sanitize($_POST["address"]);
            $type = $this->sanitize($_POST["type"]);
            $floor = $this->sanitize($_POST["floor"]);
            $door = $this->sanitize($_POST["door"]);
            $postal_code = $this->sanitize($_POST["postal_code"]);

            if (strlen($name) === 0) {
                $errors .= "El nom no pot estar buit";
            }

            if (strlen($password) === 0) {
                $errors .= "La contrasenya no pot estar buida";
            }

            if (strlen($surnames) === 0) {
                $errors .= "Els cognoms no poden estar buits";
            }

            if (strlen($born) === 0) {
                $errors .= "La data de naixement no pot estar buida";
            }

            if (strlen($email) === 0) {
                $errors .= "El correu electrònic no pot estar buit";
            }

            if (strlen($phone) === 0) {
                $errors .= "El telèfon no pot estar buit";
            }

            if (strlen($sex) === 0) {
                $errors .= "El sexe no pot estar buit";
            }

            if (strlen($poblation) === 0) {
                $errors .= "La població no pot estar buida";
            }

            if (strlen($address) === 0) {
                $errors .= "L'adreça no pot estar buida";
            }

            if (strlen($type) === 0) {
                $errors .= "El tipus no pot estar buit";
            }

            if (strlen($floor) === 0) {
                $errors .= "El pis no pot estar buit";
            }

            if (strlen($door) === 0) {
                $errors .= "La porta no pot estar buida";
            }

            if (strlen($postal_code) === 0) {
                $errors .= "El codi postal no pot estar buit";
            }

            if (!isset($errors)) {
                $this->client = $this->assignClientData($id, $name, $password, $surnames, $born, $email, $phone, $sex, $poblation, $address, $type, $floor, $door, $postal_code);

                $update = $this->clientModel->update($this->client);

                if ($update === "La consulta se ha realizado con éxito") {
                    $this->clients = $this->clientModel->read();
                    header("Location: index.php?ClientAdmin/show");
                    ClientAdminView::showClients("es", $this->clients, null);
                } else {
                    $errors = $update;
                    ClientAdminView::showClients("es", $this->clients, $this->client, false, $errors);
                }

            } else {
                ClientAdminView::showClients("es", $this->clients, null, false, $errors);
            }

        }

    }
    
    /**
     * Elimina un cliente existente.
     *
     * @param int[] $id El ID del cliente a eliminar.
     * @throws Exception Si hay un problema al eliminar el cliente.
     */
    public function deleteClient($id) {

            $delete = $this->clientModel->delete(new Client($id[0]));

            if ($delete === "La consulta se ha realizado con existo") {
                $this->clients = $this->clientModel->read();
                header("Location: index.php?ClientAdmin/show");
                ClientAdminView::showClients("es", $this->clients, null);
            } else {
                $errores = $delete;
                ClientAdminView::showClients("es", $this->clients, $this->client, false, $errores);
            }


    }

    /**
     * Muestra la página de actualización de un cliente específico.
     *
     * @param int[] $id El ID del cliente a actualizar.
     * @throws Exception Si hay un problema al acceder a los datos del cliente.
     */
    public function updateClient($id) {
        $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
        
        $this->client = new Client($id[0]);
        $consulta = $this->clientModel->getById($this->client);
        
        if ($consulta instanceof Client) {
            $this->client = $consulta;
            $this->clients = $this->clientModel->read();
            ClientAdminView::showClients($lang, $this->clients, $this->client, true);
        } else {
            $errores = $consulta;
            ClientAdminView::showClients($lang, $this->clients, null, false, $errores);
        }
    }
    
    /**
     * Asigna datos de cliente a un objeto cliente.
     *
     * @param int|null $id El ID del cliente.
     * @param string $name El nombre del cliente.
     * @param string $password La contraseña del cliente.
     * @param string $surnames Los apellidos del cliente.
     * @param string $born La fecha de nacimiento del cliente.
     * @param string $email El correo electrónico del cliente.
     * @param string $phone El número de teléfono del cliente.
     * @param string $sex El sexo del cliente.
     * @param string $poblation La población del cliente.
     * @param string $address La dirección del cliente.
     * @param string $type El tipo del cliente.
     * @param string $floor El piso del cliente.
     * @param string $door La puerta del cliente.
     * @param string $postal_code El código postal del cliente.
     * @return Client El objeto cliente creado con los datos proporcionados.
     */
    private function assignClientData($id, $name, $password, $surnames, $born, $email, $phone, $sex, $poblation, $address, $type, $floor, $door, $postal_code) {
        return new Client(
            $id,
            $name,
            $password,
            $surnames,
            $born,
            $email,
            $phone,
            $sex,
            $poblation,
            $address,
            $type,
            $floor,
            $door,
            $postal_code
        );
    }
    
}
