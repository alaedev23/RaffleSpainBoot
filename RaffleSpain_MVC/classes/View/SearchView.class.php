<?php

class SearchView extends View
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function showRaffle($lang, $rifas = null, $searchMode = false, $searchText = null, $errors = null)
    {
        // $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        // include $fitxerDeTraduccions;
        $templateRaffle = $this->showFilterRaffles($rifas); // si esta activo printea los que se hayan encontrado, sino printea aleatorios
        $templateRaffleMember = $this->showFilterRafflesMemeber($rifas);
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/SearchRaffle.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public function showProducts($lang, $productos = null, $searchMode = false, $searchText = null, $errors = null)
    {
        // $fitxerDeTraduccions = "languages/{$lang}_traduccio.php";
        // include $fitxerDeTraduccions;
        $templateProduct = $this->showFilterProducts($productos); // si esta activo printea los que se hayan encontrado, sino printea aleatorios

        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/SearchProduct.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    public function showFilterProducts($productos)
    {
        return Functions::generatecardProduct($productos);
    }
    
    public function showFilterRaffles($rifas)
    {
        return Functions::generatecardRaffle($rifas);
    }
    
    public function showFilterRafflesMemeber($rifas)
    {
        $html = '';
        foreach ($rifas as $rifa) {
            if ($rifa->type == 1) {
                if ($_SESSION['usuari']->type == 2 || $_SESSION['usuari']->type == 3) {
                    $html .= Functions::generatecardRaffleMemberOpen($rifa);
                } else {
                    $html .= Functions::generatecardRaffleMemberClose($rifa);
                }
            }
        }
        
        return $html;
    }
    
}