<?php

namespace App\Exceptions;

/**
 * Výjimka pro view not found
 */
class ViewNotFoundException extends \Exception {
    protected $message = 'View not found';
}