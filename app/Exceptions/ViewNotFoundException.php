<?php

namespace App\Exceptions;

class ViewNotFoundException extends \Exception {
    protected $message = 'View not found';
}