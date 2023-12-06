<?php

namespace App;

/**
 * Statická třída rozšiřující PHP funkce pro použití v aplikaci
 */
class Utils {

    /**
     * Rekurzivně smaže obsah složky
     * 
     * @param string $dir   Cesta ke složce pro smazání
     */
    public static function rrmdir(string $dir) { 
        if (is_dir($dir)) { 
            $objects = scandir($dir);
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                        self::rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                        unlink($dir. DIRECTORY_SEPARATOR .$object); 
                } 
            }
            rmdir($dir); 
        } 
    }

}