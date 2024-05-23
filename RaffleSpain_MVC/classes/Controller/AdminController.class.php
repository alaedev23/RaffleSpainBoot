<?php

class AdminController extends Controller {
    
    private $productsAll;
    private $rafflesAll;
    private $auxID;
    private $product;
    private $raffle;

    public function __construct() {
        $rModel = new RaffleModel();
        $pModel = new ProductModel();
        $this->productsAll = $pModel->read();
        $this->rafflesAll = $rModel->read();
    }
    
    /* Metodo que mostrara la pagina de admin.*/
    public function showAdminPage() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $pModel = new ProductModel();
        $this->productsAll = $pModel->readAll();
        
        $rModel = new RaffleModel();
        $this->rafflesAll = $rModel->read();
        
        AdminView::show($lang, $this->productsAll, $this->rafflesAll);
    }
    
    /* Metodo que creara el product */
    public function createProduct() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataCreate"]))) {
            
            $view = new AdminView();
            $modelo = new ProductModel();
            
            $nameTemp = $this->sanitize($_POST['name']);
            $brandTemp = $this->sanitize($_POST['brand']);
            $price = $this->sanitize($_POST['price']);
            $size = $this->sanitize($_POST['size']);
            $color = $this->sanitize($_POST['color']);
            $description = $this->sanitize($_POST['description']);
            $sex = $this->sanitize($_POST['sex']);
            $imatge = $this->sanitize($_FILES['imatge']['name']);
            $quantity = $this->sanitize($_POST['quantity']);
            $discount = $this->sanitize($_POST['discount']);
            
            $name = Functions::replaceSpaceForHyphen($nameTemp);
            $brand = Functions::replaceSpaceForHyphen($brandTemp);
            $modelcode = Functions::getNewModelCode($name, $brand);
            
            if (strlen($name) === 0) {
                $errores = "Error en el nom.";
            }
            
            if (strlen($brand) === 0) {
                $errores = "Error en el brand.";
            }
            
            if (strlen($price) === 0 || !is_numeric($price)) {
                $errores = "Error en el preu.";
            }
            
            if (strlen($size) === 0 || !is_numeric($size)) {
                $errores = "Error en el size.";
            }
            
            if (strlen($color) === 0 || !preg_match('/^[A-Za-z]+$/', $color)) {
                $errores = "Error en el color.";
            }
            
            if (strlen($description) === 0) {
                $errores = "Error en el descripcio.";
            }
            
            if (!in_array($sex, ['H', 'M', 'N'])) {
                $errores = "Error en el sexe, ha de ser els valors: H, D o N.";
            }
            
            if (strlen($quantity) === 0 || !is_numeric($quantity)) {
                $errores = "Error en la quantitat.";
            }
            
            if (strlen($discount) === 0 || !is_numeric($discount)) {
                $errores = "Error en el descompte.";
            }
            
            $extensiones_permitidas = ['png', 'jpg', 'jpeg'];
            $archivo_info = pathinfo($imatge);
            
            if (isset($archivo_info['extension'])) {
                $archivo_extension = strtolower($archivo_info['extension']);
                
                if (!in_array($archivo_extension, $extensiones_permitidas)) {
                    $errores = "La imagen no tiene una extensión válida.";
                }
            } else {
                $errores = "No se proporcionó una extensión de archivo.";
            }
            
            $this->product = $this->asignDataProduct(null, $name, $brand, $modelcode, $price, $size, $color, $description, $sex, $imatge, $quantity, $discount);            
            $this->productsAll = $modelo->read();
            
            if (!isset($errores)) {
                
                $extensionImagen = strtolower($archivo_info['extension']);
                $rutaDestino = __DIR__ . "/../../public/img/vambas/$brand-$name.$extensionImagen";
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaDestino)) {
//                     if (Functions::redimensionarImagen($rutaDestino)) {
                        $this->product->__set("img", "$brand-$name.$extensionImagen");
                        $create = $modelo->create($this->product);
                        var_dump($create);
                        if ($create === "La consulta se ha realizado con éxito") {
                            $this->productsAll = $modelo->read();;
                            header("Location: index.php?admin/showAdminPage");
                        } else {
                            $errores = $create;
                            $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, false, $errores);
                        }
                    } 
//                     else {
//                         $errores = "Error al redimensionar la imagen.";
//                         $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, false, $errores);
//                     }
                }
            // } else {
                $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, false, $errores);
            }
    }
    
    /* Metodo que creara la raffle*/
    public function createRaffle() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataCreate"]))) {
            
            $view = new AdminView();
            $rModelo = new RaffleModel();
            $pModelo = new ProductModel();
            
            $product_id = $this->sanitize($_POST['product_id']);
            $data_start = $this->sanitize($_POST['date_start']);
            $data_end = $this->sanitize($_POST['date_end']);
            $winner = $this->sanitize($_POST['winner']);
            $type = $this->sanitize($_POST['type']);

            if (strlen($data_start) === 0) {
                $errores = "Error en el data_start, has d'introduir un data";
            } else if (!DateTime::createFromFormat("Y-m-d H:i", $data_start)) {
                $errores = "Error en el data_start, format incorrecte";
            }
            
            if (strlen($data_end) === 0) {
                $errores = "Error en el data_end, has d'introduir un data";
            } else if (!DateTime::createFromFormat("Y-m-d H:i", $data_end)) {
                $errores = "Error en el data_end, format incorrecte";
            }
            
            if (strlen($product_id) === 0 || !is_numeric($product_id)) {
                $errores = "Error en el product_id.";
            } else if (!$pModelo->existProduct(new Product($product_id))) {
                $errores = "No existeix el id del producte introduit.";
            } else {
                $this->product = $pModelo->getById(new Product($product_id));
            }
            
            $this->raffle = $this->asignDataRaffle(null, $product_id, $data_start, $data_end, $this->product, $winner, $type);
            
            $this->rafflesAll = $rModelo->read();
            $this->productsAll = $pModelo->read();
            
            if (!isset($errores)) {
                
                $create = $rModelo->create($this->raffle);
                
                $this->productsAll = $pModelo->read();
                $this->rafflesAll = $rModelo->read();
                
                if ($create === "La consulta se ha realizado con éxito") {
                    $this->productsAll = $rModelo->read();
                    header("Location: index.php?admin/showAdminPage");
                    $view->show($lang, $this->productsAll, $this->rafflesAll, null);
                } else {
                    $errores = $create;
                    $view->show($lang, $this->productsAll, $this->rafflesAll, $this->raffle, false, $errores);
                }
            } else {
                $view->show($lang, $this->productsAll, $this->rafflesAll, $this->raffle, false, $errores);
            }
        }
    }
    
    /* Metodo que  updateara la pagina al producto previamente seleccionado */
    public function updateProductSelected() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataUpdate"]))) {
            
            $view = new AdminView();
            $modelo = new ProductModel();
            
            $nameTemp = $this->sanitize($_POST['name']);
            $brandTemp = $this->sanitize($_POST['brand']);
            $price = $this->sanitize($_POST['price']);
            $size = $this->sanitize($_POST['size']);
            $color = $this->sanitize($_POST['color']);
            $description = $this->sanitize($_POST['description']);
            $sex = $this->sanitize($_POST['sex']);
            $imatge = $this->sanitize($_FILES['imatge']['name']);
            $quantity = $this->sanitize($_POST['quantity']);
            $discount = $this->sanitize($_POST['discount']);
            
            $name = Functions::replaceSpaceForHyphen($nameTemp);
            $brand = Functions::replaceSpaceForHyphen($brandTemp);
            
            $auxObject = $modelo->readForNameBrand(new Product(null, $name, $brand));
            $modelCode = $auxObject[0]->__get("modelCode");
            $id = $auxObject[0]->__get("id");
            
            if (strlen($name) === 0) {
                $errores = "Error en el nom.";
            }
            
            if (strlen($brand) === 0) {
                $errores = "Error en el brand.";
            }
            
            if (strlen($price) === 0 || !is_numeric($price)) {
                $errores = "Error en el preu.";
            }
            
            if (strlen($size) === 0 || !is_numeric($size)) {
                $errores = "Error en el size.";
            }
            
            if (strlen($color) === 0 || !preg_match('/^[A-Za-z]+$/', $color)) {
                $errores = "Error en el color.";
            }
            
            if (strlen($description) === 0) {
                $errores = "Error en el descripcio.";
            }
            
            if (!in_array($sex, ['H', 'M', 'N'])) {
                $errores = "Error en el sexe, ha de ser els valors: H, D o N.";
            }
            
            $extensiones_permitidas = ['png'];
            $archivo_info = pathinfo($imatge);
            
            if (isset($archivo_info['extension'])) {
                $archivo_extension = strtolower($archivo_info['extension']);
                
                if (!in_array($archivo_extension, $extensiones_permitidas)) {
                    $errores = "La imagen no tiene una extensión válida.";
                }
            } else {
                $errores = "No se proporcionó una extensión de archivo.";
            }
            
            if (strlen($quantity) === 0 || !is_numeric($quantity)) {
                $errores = "Error en la quantitat.";
            }
            
            if (strlen($discount) === 0 || !is_numeric($discount)) {
                $errores = "Error en el descompte.";
            }
            
            $this->product = $this->asignDataProduct($id, $name, $brand, $modelCode, $price, $size, $color, $description, $sex, $imatge, $quantity, $discount);
            $this->productsAll = $modelo->read();
            
            if (!isset($errores)) {
                
                $rutaDestino = __DIR__ . "/../../public/img/vambas/$brand-$name.png";
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaDestino)) {
                    $this->product->__set("img", "$brand-$name.png");
                    $update = $modelo->update($this->product);
                    
                    if ($update === "La consulta se ha realizado con éxito") {
                        $this->productsAll = $modelo->read();
                        header("Location: index.php?admin/showAdminPage");
                        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false);
                    } else {
                        $errores = $update;
                        $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, true, $errores);
                    }
                }
            } else {
                $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, true, $errores);
            }
        }
    }
    
    /* Metodo que updateara la pagina a la rifa previamente seleccionado */
    public function updateRaffleSelected() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataUpdate"]))) {
            
            $view = new AdminView();
            $rModelo = new RaffleModel();
            $pModelo = new ProductModel();
            
            $id = $this->sanitize($_POST['id']);
            $product_id = $this->sanitize($_POST['product_id']);
            $data_start = $this->sanitize($_POST['date_start']);
            $data_end = $this->sanitize($_POST['date_end']);
            $winner = $this->sanitize($_POST['winner']);
            if ($winner === "null") {
                $winner = '';
            }
            $type = $this->sanitize($_POST['type']);
            
            if (strlen($data_start) === 0) {
                $errores = "Error en el data_start, has d'introduir un data";
            } else if (!DateTime::createFromFormat("Y-m-d H:i", $data_start)) {
                $errores = "Error en el data_start, format incorrecte";
            }
            
            if (strlen($data_end) === 0) {
                $errores = "Error en el data_end, has d'introduir un data";
            } else if (!DateTime::createFromFormat("Y-m-d H:i", $data_end)) {
                $errores = "Error en el data_end, format incorrecte";
            }
            
            $auxProduct = new Product($product_id);
            $result = $pModelo->getById($auxProduct);
            
            if (strlen($product_id) === 0 || !is_numeric($product_id)) {
                $errores = "Error en el product_id.";
            } else if (!($result instanceof Product)) {
                $errores = "No existeix el id del producte introduit.";
            } else {
                $this->product = $result;
            }
            
            $this->raffle = $this->asignDataRaffle($id, $product_id, $data_start, $data_end, $this->product, $winner, $type);
            
            $this->rafflesAll = $rModelo->read();
            $this->productsAll = $pModelo->read();
            
            if (!isset($errores)) {
                
                $update = $rModelo->update($this->raffle);
                
                $this->productsAll = $pModelo->read();
                $this->rafflesAll = $rModelo->read();
                
                if ($update === "La consulta se ha realizado con éxito") {
                    header("Location: index.php?admin/showAdminPage");
                    $view->show($lang, $this->productsAll, $this->rafflesAll, null, false);
                } else {
                    $errores = $update;
                    $view->show($lang, $this->productsAll, $this->rafflesAll, $this->raffle, true, $errores);
                }
            } else {
                $view->show($lang, $this->productsAll, $this->rafflesAll, $this->raffle, true, $errores);
            }
        }
    }
    
/* Metodo para actualizar un producto
*
* @param string $id id del producto
*/
public function updateProduct($id) {
    // Obtención del idioma desde la cookie, predeterminado 'ca' si no se encuentra
    $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
    // Creación de instancias de modelos y vista
    $pModelo = new ProductModel();
    $rModelo = new RaffleModel();
    $view = new AdminView();
    // Creación del objeto Producto con el ID proporcionado
    $this->product = new Product($id[0]);
    // Consulta para obtener el producto por su ID
    $consulta = $pModelo->getById($this->product);
    // Verificación de si la consulta devuelve una instancia de Producto
    if ($consulta instanceof Product) {
        // Si el producto existe, se asigna y se muestran productos y sorteos en la vista de administrador
        $this->product = $consulta;
        $this->rafflesAll = $rModelo->read();
        $this->productsAll = $pModelo->read();
        $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, true);
    } else {
        // Si el producto no existe, se muestra un mensaje de error en la vista de administrador
        $errores = $consulta;
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
    }
}

/* Metodo para actualizar una rifa
*
* @param string $id id de la rifa
*/
public function updateRaffle($id) {
    // Obtención del idioma desde la cookie, predeterminado 'ca' si no se encuentra
    $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
    // Creación de instancias de modelos y vista
    $pModelo = new ProductModel();
    $rModelo = new RaffleModel();
    $view = new AdminView();
    // Creación del objeto Sorteo con el ID proporcionado
    $this->raffle = new Raffle($id[0]);
    // Consulta para obtener el sorteo por su ID
    $consulta = $rModelo->getById($this->raffle);
    // Verificación de si la consulta devuelve una instancia de Sorteo
    if ($consulta instanceof Raffle) {
        // Si el sorteo existe, se asigna y se muestran productos y sorteos en la vista de administrador
        $this->raffle = $consulta;
        $this->rafflesAll = $rModelo->read();
        $this->productsAll = $pModelo->read();
        $view->show($lang, $this->productsAll, $this->rafflesAll, $this->raffle, true);
    } else {
        // Si el sorteo no existe, se muestra un mensaje de error en la vista de administrador
        $errores = $consulta;
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
    }
}

/* Metodo para eliminar un producto
*
* @param string $id id del producto
*/
public function deleteProduct($id) {
    // Obtención del idioma desde la cookie, predeterminado 'ca' si no se encuentra
    $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
    // Creación de instancias de modelos y vista
    $pModelo = new ProductModel();
    $rModelo = new RaffleModel();
    $view = new AdminView();
    // Creación del objeto Producto con el ID proporcionado
    $this->product = new Product($id[0]);
    // Eliminación del producto y obtención del resultado
    $consulta = $pModelo->delete($this->product);
    // Verificación del resultado de la eliminación del producto
    if ($consulta === "La consulta se ha realizado con éxito") {
        // Si la eliminación tiene éxito, se actualizan los productos y sorteos en la vista de administrador
        $this->rafflesAll = $rModelo->read();
        $this->productsAll = $pModelo->read();
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false);
    } else {
        // Si hay un error en la eliminación, se muestra un mensaje de error en la vista de administrador
        $errores = $consulta;
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
    }
}

/* Metodo para borrar una rifa
*
* @param string $id id de la rifa
*/
public function deleteRaffle($id) {
    // Obtención del idioma desde la cookie, predeterminado 'ca' si no se encuentra
    $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
    // Creación de instancias de modelos y vista
    $pModelo = new ProductModel();
    $rModelo = new RaffleModel();
    $view = new AdminView();
    // Creación del objeto Sorteo con el ID proporcionado
    $this->raffle = new Raffle($id[0], null, null, null);
    // Eliminación del sorteo y obtención del resultado
    $consulta = $rModelo->delete($this->raffle);
    // Verificación del resultado de la eliminación del sorteo
    if ($consulta === "La consulta se ha realizado con éxito") {
        // Si la eliminación tiene éxito, se actualizan los productos y sorteos en la vista de administrador
        $this->rafflesAll = $rModelo->read();
        $this->productsAll = $pModelo->read();
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false);
    } else {
        // Si hay un error en la eliminación, se muestra un mensaje de error en la vista de administrador
        $errores = $consulta;
        $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
    }
}

    
    /**
     * Asigna los datos de un producto para su creación o actualización.
     *
     * @param int|null $id El ID del producto si existe, o null para un nuevo producto.
     * @param string $name El nombre del producto.
     * @param string $brand La marca del producto.
     * @param string $modelCode El código de modelo del producto.
     * @param float $price El precio del producto.
     * @param int $size El tamaño del producto.
     * @param string $color El color del producto.
     * @param string $description La descripción del producto.
     * @param string $sex El género del producto.
     * @param string $img El nombre del archivo de imagen del producto.
     * @param int $quantity La cantidad disponible del producto.
     * @param float $discount El descuento aplicado al producto.
     * @return Product El objeto Product creado con los datos proporcionados.
     */
    private function asignDataProduct($id, $name, $brand, $modelCode, $price, $size, $color, $description, $sex, $img, $quantity, $discount) {
        return new Product (
            $id,
            $name,
            $brand,
            $modelCode,
            $price,
            $size,
            $color,
            $description,
            $sex,
            $img,
            $quantity,
            $discount
        );
    }
    
    /**
     * Asigna los datos de un sorteo para su creación o actualización.
     *
     * @param int|null $id El ID del sorteo si existe, o null para un nuevo sorteo.
     * @param int $product_id El ID del producto asociado al sorteo.
     * @param string $date_start La fecha de inicio del sorteo.
     * @param string $date_end La fecha de fin del sorteo.
     * @param Product $product El objeto Producto asociado al sorteo.
     * @param string|null $winner El ganador del sorteo, si existe.
     * @param string $type El tipo de sorteo.
     * @return Raffle El objeto Raffle creado con los datos proporcionados.
     */
    private function asignDataRaffle($id, $product_id, $date_start, $date_end, $product, $winner, $type) {
        return new Raffle (
            $id,
            $product_id,
            $date_start,
            $date_end,
            $product,
            $winner,
            $type
        );
    }
    
}