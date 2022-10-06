<?php

namespace src\Controllers;
use src\Models\ProductosModel;

class Productos
{
    private $model;

    function __construct()
    {
        $this->model = new ListaProductosModel();
        print_r('Soy el controlador de ListaProductos');
    }

    public function getListaProductos()
    {
        $productos = $this->model->getAllProductos();
        // echo $this->twig->render('list.html.twig', ['productos' => $productos]);
    }
}
