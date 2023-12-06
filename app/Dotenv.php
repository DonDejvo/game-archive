<?php

namespace App;

/**
 * Třída pro práci s .env soubory
 */
class Dotenv {

    private array $values = [];

    /**
     * Načte a zparsuje .env soubor
     * 
     * @param string $path  Cesta k souboru
     */
    public function load(string $path): void {

        $lines = file($path . '/.env', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

        foreach($lines as $line) {

            $tokens = explode('=', $line);

            if(isset($tokens[1])) {

                $name = trim($tokens[0]);
                $value = trim($tokens[1]);

                $this->values[$name] = $value;
            }
        }

    }

    /**
     * Vrátí hodnotu vlastnosti načteného souboru, pokud existuje
     * 
     * @param string $name Název vlastnosti
     */
    public function get($name): ?string {
        return $this->values[$name];
    }

}