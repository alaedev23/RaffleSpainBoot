<?php

class SearchView extends View
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show($lang, $productos = null, $searchMode = false, $errors = null)
    {
        // $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        // include $fitxerDeTraduccions;
        $templateProduct = $this->showFilterProducts($productos); // si esta activo printea los que se hayan encontrado, sino printea aleatorios

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Search.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public function showFilterProducts($productos)
    {
        return Functions::generatecardProduct($productos);
    }
}