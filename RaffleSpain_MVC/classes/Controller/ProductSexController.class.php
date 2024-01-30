<?php

//             echo "<pre>";
//             var_dump($productos);
//             echo "</pre>";

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
        
        $sexo = $this->sanitize($sexo[0]);
        $sexo = strtoupper($sexo[0]);
        
        if (!in_array($sexo, self::SEXO)) {
            $errores = "No coincide el sexo enviado";
        }
        
        if (!isset($errores)) {
            $productos = $model->readForSex($sexo);
            if (count($productos) > 0) {
                $vista->showView($lang, $sexo, $productos);
            } else {
                $errores = "No hay productos para este sexo.";
                $vista->showView($lang, $sexo, null, $errores);
            }
        } else {
            $vista->showView($lang, $sexo, null, $errores);
        }
    }
    
}