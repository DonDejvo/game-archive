<?php

namespace App;

class Dotenv {

    private array $values = [];

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

    public function get($name): ?string {
        return $this->values[$name];
    }

}