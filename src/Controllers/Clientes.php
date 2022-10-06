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
        print_r('Soy el controlador de Clientes');
        
    }

    public function clientes()
    {
        $this->clientes = $this->model->getAllClientes();
        echo "<pre>";
        print_r($this->clientes);
        echo "</pre>";
        // echo $this->twig->render('list.html.twig', ['clientes' => $clientes]);
    }


    public function getDetalleCliente($id)
    {
        $this->detalles = $this->model->getDetallesCliente($id);
        echo "<pre>";
        print_r($this->detalles);
        echo "</pre>";
        //echo $this->twig->render('detail.html.twig', ['detalle' => $this->detalles]);
    }
}

