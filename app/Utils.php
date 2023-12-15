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

    /**
     * Rekurzivně zkopíruje obsah složky
     * 
     * @param string $sourceDirectory           vstupní složka
     * @param string $destinationDirectory      výstupní složka
     * @param string $childFolder
     */
    public static function rcpdir(
        string $sourceDirectory,
        string $destinationDirectory,
        string $childFolder = ''
    ): void {
        $directory = opendir($sourceDirectory);
    
        if (is_dir($destinationDirectory) === false) {
            mkdir($destinationDirectory);
        }
    
        if ($childFolder !== '') {
            if (is_dir("$destinationDirectory/$childFolder") === false) {
                mkdir("$destinationDirectory/$childFolder");
            }
    
            while (($file = readdir($directory)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
    
                if (is_dir("$sourceDirectory/$file") === true) {
                    self::rcpdir("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                } else {
                    copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                }
            }
    
            closedir($directory);
    
            return;
        }
    
        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
    
            if (is_dir("$sourceDirectory/$file") === true) {
                self::rcpdir("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
            else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
        }
    
        closedir($directory);
    }

    /**
     * Vytvoří ZIP ze složky
     * 
     * @param \ZipArchive $zipArchive   ZipArchive instance
     * @param string $folder            cesta ke složka
     * @param string $childFolder
     */
    public static function createZip(\ZipArchive $zipArchive, string $folder, string $childFolder = '') {
        $f = opendir($folder);

        while (($file = readdir($f)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_file($folder . $file)) {
                $zipArchive->addFile($folder . $file, $childFolder . basename($file));
            } elseif (is_dir($folder . $file)) {
                $subfolder = $folder . $file . '/';
                self::createZip($zipArchive, $subfolder, $childFolder . $file . '/');
            }
        }
            
        closedir($f);
    }
}