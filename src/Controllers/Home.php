<?php

namespace src\Controllers;
use src\Models\HomeModel;

class Home
{
    private $model;

    function __construct()
    {
        $this->model = new HomeModel();
        print_r('Soy el controlador de Home');
    }

}
