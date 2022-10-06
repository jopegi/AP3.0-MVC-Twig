<?php 

namespace src\Controllers;
use src\Core\Interfaces\ClientesControllerI;
use src\Models\ClientesModel;

class Clientes implements ClientesControllerI
{

    private $model;
    private $clientes = [];
    private $detalles = [];

    function __construct()
    {
        $this->model = new ClientesModel();
        print_r('Soy el controlador de DetalleCliente');
        
    }

    public function getListaClientes()
    {
        $this->clientes = $this->model->getAllClientes();
        // echo $this->twig->render('list.html.twig', ['clientes' => $clientes]);
    }


    public function getDetalleCliente($id)
    {
        $this->detalle = $this->model->getDetallesCliente($id);
        echo $this->twig->render('detail.html.twig', ['detalle' => $this->detalle]);
    }
}

