<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected static function error($msg = 'An error has occurred.') {
        return array(
            'error' => $msg,
        );
    }
}
