<?php

/**
 * La clase Autoloader proporciona funciones para cargar automáticamente clases en PHP.
 */
class Autoloader
{
    /**
     * Constante que define las carpetas donde se buscarán las clases.
     */
    private const CARPETAS = ['Model', 'View', 'Controller', 'Config'];
    
    /**
     * Carga una clase mediante la convención de nombres de PSR-4.
     *
     * @param string $clase El nombre de la clase a cargar.
     * @return void
     */
    public static function load($clase)
    {
        foreach (self::CARPETAS as $carpeta) {
            if (file_exists("classes/$carpeta/" . ucfirst($clase) . '.class.php')) {
                include "classes/$carpeta/" . ucfirst($clase) . '.class.php';
                return;
            }
        }
    }
    
    /**
     * Carga una clase mediante su nombre sin modificar.
     *
     * @param string $clase El nombre de la clase a cargar.
     * @return void
     * @throws Exception Cuando no se encuentra la definición de la clase.
     */
    public static function newload($clase)
    {
        foreach (self::CARPETAS as $carpeta) {
            if (file_exists("classes/$carpeta/" . $clase . '.php')) {
                include "classes/$carpeta/" . $clase . '.php';
                return;
            }
        }
        throw new Exception("No s'ha trobat la definicio de la classe $clase");
    }
}
