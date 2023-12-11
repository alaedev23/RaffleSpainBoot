<?php

class Controller {

    public function __construct()
    {}
    
    /**
     *
     * @param mixed $stringANetejar : Cadena a la que volem eliminar els caràcters perillosos
     * @return string|mixed
     */
    function sanitize ($stringANetejar){
        if (strlen($stringANetejar)==0) {
            $stringANetejar = "";
        } else {
            $stringANetejar = trim($stringANetejar);
            $stringANetejar = htmlspecialchars(stripslashes(trim($stringANetejar, '-')));
            $stringANetejar = strip_tags($stringANetejar);
            // Preserve escaped octets.
            $stringANetejar = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $stringANetejar);
            // Remove percent signs that are not part of an octet.
            $stringANetejar = str_replace('%', '', $stringANetejar);
            // Restore octets.
            $stringANetejar = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $stringANetejar);
        }
        return $stringANetejar;
    }
    
}

