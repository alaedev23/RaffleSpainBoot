<?php

class AdminController extends Controller {
    
    private $productsAll;
    private $rafflesAll;
    
    private $product;
    private $raffle;

    public function __construct() {
        $rModel = new RaffleModel();
        $pModel = new ProductModel();
        $this->productsAll = $pModel->read();
        $this->rafflesAll = $rModel->read();
    }
    
    
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
    
    public function createProduct() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataCreate"]))) {
            
            $view = new AdminView();
            $modelo = new ProductModel();
            
            $id = $this->sanitize($_POST['id']);
            $nameTemp = $this->sanitize($_POST['name']);
            $brandTemp = $this->sanitize($_POST['brand']);
            $modelcodeTemp = $this->sanitize($_POST['modelcode']);
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
            
            if (strlen($modelcodeTemp) != 0) {
                $errores = "No tens que posar el modelCode.";
            } else {
                $modelcode = Functions::getNewModelCode($name, $brand);
            }
            
            if (strlen($id) != 0) {
                $errores = "No tens que posar l'id.";
            }
            
            if (strlen($name) === 0) {
                $errores = "Error en el nom.";
            }
            
            if (strlen($brand) === 0) {
                $errores = "Error en el brand.";
            }
            
//             if (ctype_space($name) || ctype_space($brand)) {
//                 $errores = "No pot haver-hi espais en els camps de Nom o de Brand. Se tiene que separara por guines (-).";
//             }
            
            if (strlen($modelcode) != 0 || !is_numeric($price)) {
                $errores = "No tens que posar el modelcode.";
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
            
            $this->product = $this->asignData($id, $name, $brand, $modelcode, $price, $size, $color, $description, $sex, $imatge, $quantity, $discount);            
            $this->productsAll = $modelo->read();
            
            if (!isset($errores)) {
                
                $rutaDestino = __DIR__ . "/../../public/img/vambas/$brand-$name.png";
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaDestino)) {
                    $this->product->__set("img", "$brand-$name.png");
                    $create = $modelo->create($this->product);
                    
                    if ($create === "La consulta se ha realizado con existo") {
                        $this->productsAll = $modelo->read();
                        header("Location: index.php?admin/showAdminPage");
                        $view->show($lang, $this->productsAll, $this->rafflesAll, null);
                    } else {
                        $errores = $create;
                        $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, false, $errores);
                    }
                }
            } else {
                $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, false, $errores);
            }
        }
    }
    
    public function updateProductSelected() {
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataUpdate"]))) {
            
            $view = new AdminView();
            $modelo = new ProductModel();
            
            $id = $this->sanitize($_POST['id']);
            $nameTemp = $this->sanitize($_POST['name']);
            $brandTemp = $this->sanitize($_POST['brand']);
            $modelcode = $this->sanitize($_POST['modelcode']);
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
            
            $objAux = $modelo->getById(new Product($id));
            
            if ($objAux instanceof Product) {
                if (!($objAux->modelCode === $modelcode)) {
                    $errores = "No es pot modificar el modelCode";
                }
            } else {
                $errores = "No es pot modificar l'id";
            }
            
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
            
            $this->product = $this->asignData($id, $name, $brand, $modelcode, $price, $size, $color, $description, $sex, $imatge, $quantity, $discount);
            $this->productsAll = $modelo->read();
            
            if (!isset($errores)) {
                
                $rutaDestino = __DIR__ . "/../../public/img/vambas/$brand-$name.png";
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaDestino)) {
                    $this->product->__set("img", "$brand-$name.png");
                    $update = $modelo->update($this->product);
                    
                    if ($update === "La consulta se ha realizado con existo") {
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
    
    public function deleteProduct($id) {
        $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
        
        $pModelo = new ProductModel();
        $rModelo = new RaffleModel();
        $view = new AdminView();
        
        $this->product = new Product($id[0]);
        $consulta = $pModelo->delete($this->product);
        
        if ($consulta === "La consulta se ha realizado con existo") {
            $this->rafflesAll = $rModelo->read();
            $this->productsAll = $pModelo->read();
            $view->show($lang, $this->productsAll, $this->rafflesAll, null, false);
        } else {
            $errores = $consulta;
            $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
        }
        
    }
    
    public function updateProduct($id) {
        $lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : "ca";
        
        $pModelo = new ProductModel();
        $rModelo = new RaffleModel();
        $view = new AdminView();
        
        $this->product = new Product($id[0]);
        $consulta = $pModelo->getById($this->product);
        
        if ($consulta instanceof Product) {
            $this->product = $consulta;
            $this->rafflesAll = $rModelo->read();
            $this->productsAll = $pModelo->read();
            $view->show($lang, $this->productsAll, $this->rafflesAll, $this->product, true);
        } else {
            $errores = $consulta;
            $view->show($lang, $this->productsAll, $this->rafflesAll, null, false, $errores);
        }
    }
    
    private function asignData($id, $name, $brand, $modelCode, $price, $size, $color, $description, $sex, $img, $quantity, $discount) {
        return new Product(
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
    
}