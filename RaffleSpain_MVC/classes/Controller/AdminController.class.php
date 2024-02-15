<?php

class AdminController extends Controller {
    
    private $productsAll;
    private $rafflesAll;
    
    private $products;
    private $raffles;
    
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
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["sendDataCrear"]))) {
            
            $view = new AdminView();
            $modelo = new ProductModel();
            
            $id = $this->sanitize($_POST['id']);
            $name = $this->sanitize($_POST['name']);
            $brand = $this->sanitize($_POST['brand']);
            $modelcode = $this->sanitize($_POST['modelcode']);
            $price = $this->sanitize($_POST['price']);
            $size = $this->sanitize($_POST['size']);
            $color = $this->sanitize($_POST['color']);
            $description = $this->sanitize($_POST['description']);
            $sex = $this->sanitize($_POST['sex']);
            $imatge = $this->sanitize($_FILES['img']['name']);
            $quantity = $this->sanitize($_POST['quantity']);
            $discount = $this->sanitize($_POST['discount']);
            
            if (strlen($id) != 0) {
                $errores = "No tens que posar l'id.";
            }
            
            if (strlen($name) === 0) {
                $errores = "Error en el nom.";
            }
            
            if (strlen($brand) === 0) {
                $errores = "Error en el brand.";
            }
            
            if (ctype_space($name) || ctype_space($brand)) {
                $errores = "No pot haver-hi espais en els camps de Nom o de Brand.";
            }
            
            if (strlen($modelcode) != 0) {
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
            
            $extensiones_permitidas = ['jpg', 'jpeg', 'png'];
            $archivo_info = pathinfo($_FILES['imatge']['name']);
            
            if (isset($archivo_info['extension'])) {
                $archivo_extension = strtolower($archivo_info['extension']);
                
                if (!in_array($archivo_extension, $extensiones_permitidas)) {
                    $errores = "La imagen no tiene una extensión válida.";
                }
            } else {
                $errores = "No se proporcionó una extensión de archivo.";
            }
            
            $zona = new Product();
            $zona->__set("titol", $titol);
            $zona->__set("subtitol", $subtitol);
            $zona->__set("dates", $dates);
            
            $this->esdevenimentAll = $modelo->read();
            
            if (!isset($errores)) {
                
                $rutaDestino = __DIR__ . "/../../uploads/{$imatge}";
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaDestino)) {
                    $zona->__set("imatge", "uploads/{$imatge}");
                    $create = $modelo->create($zona);
                    
                    if ($create === "La consulta se ha realizado con existo") {
                        $this->esdevenimentAll = $modelo->read();
                        $view->show($this->esdevenimentAll, $lang);
                    } else {
                        $errores = $create;
                        $view->show($this->esdevenimentAll, $lang, $zona, false, $errores);
                    }
                }
            } else {
                var_dump($errores);
                $view->show($this->esdevenimentAll, $lang, $zona, false, $errores);
            }
        }
    }
    
    private function asignData($data)
    {
        return new Product(
            $data['id'],
            $data['name'],
            $data['brand'],
            $data['modelCode'],
            $data['price'],
            $data['size'],
            $data['color'],
            $data['description'],
            $data['sex'],
            $data['img'],
            $data['quantity'],
            $data['discount']
            );
    }
    
}