<?php

class ProductSexController extends Controller {
    
    private $productList;
    private const SEXO = ["H", "M", "N"];
    
    public function show($sexo) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $vista = new ProductSexView();
        $model = new ProductModel();
        
        //             echo "<pre>";
        //             var_dump($productos);
        //             echo "</pre>";
        
        $sexo = strtoupper($sexo[0]);
        
        if (!in_array($sexo, self::SEXO)) {
            $errores = "No coincide el sexo enviado";
        }
        
        if (!isset($errores)) {
            $productos = $model->readForSex($sexo);

        } else {
            throw new Exception("No coincide el sexo enviado");
        }
        
//         $vLogin = new ClientView();
//         if (!isset($errors)) {
//             $cLogin = new ClientModel();
//             $consulta = $cLogin->getById($this->login);
//             var_dump($consulta);
//             if ($consulta->__get("id") !== null) {
//                 echo "hola";
//                 $_SESSION['usuari'] = $consulta;
//                 header("Location: index.php");
//             }
//             else {
//                 $errors = "El login es incorrecto";
//                 $vLogin->showLogin($this->login, $lang, $errors);
//             }
//         }
//         else {
//             $vLogin->showLogin($this->login, $lang, $errors);
//         }
    }
    
}