<?php

class Autoloader
{
    private const CARPETAS = ['Model', 'View', 'Controller', 'Config'];

    public static function load($clase)
    {
        foreach (self::CARPETAS as $carpeta) {
            if (file_exists("classes/$carpeta/" . ucfirst($clase) . '.class.php')) {
                include "classes/$carpeta/" . ucfirst($clase) . '.class.php';
                return;
            }
        }
        //         throw new Exception("No s'ha trobat la definicio de la classe $clase");
    }

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

// class Autoloader{
//     private const CARPETAS = ['Model', 'View', 'Controller'];

//     public static function load($clase){
//         foreach (self::CARPETAS as $carpeta) {
//             if (file_exists("classes/$carpeta/".ucfirst($clase).'.class.php')) {
//                 include "classes/$carpeta/".ucfirst($clase).'.class.php';
//                 return;
//             }
//         }
//         throw new Exception("No s'ha trobat la definicio de la classe $clase");
//     }


// }