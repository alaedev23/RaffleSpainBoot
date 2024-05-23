<?php

class ProductSexController extends Controller {
    
    private $productList;
    private const TIPO = ["H", "M", "N"];
    
    public function show($tipo) {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        $vista = new ProductSexView();
        $model = new ProductModel();
        
        $tipo = $this->sanitize($tipo[0]);
        $tipo = strtoupper($tipo[0]);
        
        if (!in_array($tipo, self::TIPO)) {
            $errores = "No coincide el tipo enviado";
        }
        
        if (!isset($errores)) {
            $productos = $model->readForSex($tipo);
            if (count($productos) > 0) {
                $vista->showView($lang, $tipo, $productos);
            } else {
                $errores = "No hay productos para este tipo.";
                $vista->showView($lang, $tipo, null, $errores);
            }
        } else {
            $vista->showView($lang, $tipo, null, $errores);
        }
    }
    
}