<?php 

namespace src\Controllers;
use src\Models\PedidosModel;

class Pedidos {

    private $model;

    function __construct()
    {
        $this->model = new PedidosModel();
        print_r('Soy el controlador de Pedidos');
    }

    public function getPedidos()
    {
        $pedidos = $this->model->getAllPedidos();
        // echo $this->twig->render('detail.html.twig', ['pedidos' => $pedidos]);
    }

}