<?php

/**
 * Clase RaffleView
 *
 * Esta clase se utiliza para mostrar vistas relacionadas con rifas.
 */
class RaffleView extends View {
    
    /**
     * Constructor de la clase.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Muestra la vista de la rifa.
     *
     * @param object $rifa Información de la rifa.
     * @param bool $isInRaffle Indica si el usuario está participando en la rifa.
     * @param bool $dateVerify Indica si la fecha de la rifa ha pasado.
     */
    public static function show($rifa, $isInRaffle, $dateVerify) {
        
        $infoRaffle = self::generateInfoRaffle($rifa, $isInRaffle, $dateVerify);
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body>";
        include "templates/Header.tmp.php";
        include "templates/Rifa.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    /**
     * Genera la información de la rifa.
     *
     * @param object $rifa Información de la rifa.
     * @param bool $isInRaffle Indica si el usuario está participando en la rifa.
     * @param bool $dateVerify Indica si la fecha de la rifa ha pasado.
     * @return string HTML con la información de la rifa.
     */
    public static function generateInfoRaffle($rifa, $isInRaffle, $dateVerify) {
        $html = '
        <h1>' . str_replace('-', ' ', $rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) . '</h1>
        <h1>' . $rifa->product->price . ' €</h1>
        <h3>Participa hasta el ' . $rifa->date_end . '</h3>';
        
        if ($dateVerify) {
            $html .= '<p>Se ha acabado la rifa. Consulte su apartado de "Mis Premios" para ver si ha ganado la rifa. Mucha suerte!</p>';
        }  else if (isset($_SESSION['usuari']) && $isInRaffle) {
            $html .= "<a href='?Raffle/toggleUser/{$rifa->id}/{$_SESSION['usuari']->id}/' class='btn'>Dejar de participar</a>";
        } else if (isset($_SESSION['usuari'])) {
            $html .= "<a href='?Raffle/toggleUser/{$rifa->id}/{$_SESSION['usuari']->id}/' class='btn'>Participar en la rifa</a>";
        } else {
            $html .= '<p>Para participar en la rifa debes iniciar sesión</p>';
        }
        
        return $html;
    }    

}