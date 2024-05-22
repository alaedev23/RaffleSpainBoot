<?php

/**
 * Clase SearchView
 *
 * Esta clase se utiliza para mostrar vistas relacionadas con la búsqueda de productos y rifas.
 */
class SearchView extends View
{

    /**
     * Constructor de la clase.
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Muestra la vista de búsqueda de rifas.
     *
     * @param string $lang Idioma de la página.
     * @param array|null $rifas Lista de rifas encontradas.
     * @param bool $searchMode Indica si se encuentra en modo de búsqueda.
     * @param string|null $searchText Texto de búsqueda.
     * @param array|null $errors Errores de la búsqueda.
     */
    public function showRaffle($lang, $rifas = null, $searchMode = false, $searchText = null, $errors = null)
    {
        $templateRaffle = $this->showFilterRaffles($rifas); // si esta activo printea los que se hayan encontrado, sino printea aleatorios
        $templateRaffleMember = $this->showFilterRafflesMemeber($rifas);
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/SearchRaffle.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    /**
     * Muestra la vista de búsqueda de productos.
     *
     * @param string $lang Idioma de la página.
     * @param array|null $productos Lista de productos encontrados.
     * @param bool $searchMode Indica si se encuentra en modo de búsqueda.
     * @param string|null $searchText Texto de búsqueda.
     * @param array|null $errors Errores de la búsqueda.
     */
    public function showProducts($lang, $productos = null, $searchMode = false, $searchText = null, $errors = null)
    {
        $templateProduct = $this->showFilterProducts($productos); // si esta activo printea los que se hayan encontrado, sino printea aleatorios

        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/SearchProduct.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }

    /**
     * Genera la plantilla para filtrar los productos.
     *
     * @param array|null $productos Lista de productos.
     * @return string HTML con los productos filtrados.
     */
    public function showFilterProducts($productos)
    {
        return Functions::generatecardProduct($productos);
    }
    
    /**
     * Genera la plantilla para filtrar las rifas.
     *
     * @param array|null $rifas Lista de rifas.
     * @return string HTML con las rifas filtradas.
     */
    public function showFilterRaffles($rifas)
    {
        return Functions::generatecardRaffle($rifas);
    }
    
    /**
     * Genera la plantilla para filtrar las rifas según el tipo de usuario.
     *
     * @param array|null $rifas Lista de rifas.
     * @return string HTML con las rifas filtradas según el tipo de usuario.
     */
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