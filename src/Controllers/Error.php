<?php

namespace src\Controllers;

class Error
{
    function __construct()
    {
        echo 'Error Controller';
    }

    public function error()
    {
        echo $this->twig->render('404.html', []);
    }
}
