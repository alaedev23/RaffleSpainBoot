<?php
class Autoloader{
    private const CARPETAS = ['Model', 'View', 'Controller'];
    // $Config

    public static function load($clase){
        foreach (self::CARPETAS as $carpeta) {
            if (file_exists("classes/$carpeta/".ucfirst($clase).'.class.php')) {
                include "classes/$carpeta/".ucfirst($clase).'.class.php';
                return;
            }
        }
        throw new Exception("No s'ha trobat la definicio de la classe $clase");
    }
    
    
}
