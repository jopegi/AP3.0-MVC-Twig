<?php

namespace src\Controllers;

use src\Models\ProductosModel;

class Productos
{
    private $model;

    function __construct()
    {
        $this->model = new ProductosModel();
        print_r('Soy el controlador de Productos');
    }

    public function productos()
    {
        $productos = $this->model->getAllProductos();
        echo "<pre>";
        print_r($productos);
        echo "</pre>";
        // echo $this->twig->render('list.html.twig', ['productos' => $productos]);
    }
}
