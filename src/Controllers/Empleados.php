<?php 

namespace src\Controllers;
use src\Models\EmpleadosModel;

class Empleados {

    private $model;

    function __construct()
    {
        $this->model = new EmpleadosModel();
        print_r('Soy el controlador de Empleados');
    }

    public function getEmpleados()
    {
        $empleados = $this->model->getEmpleados();
        // echo $this->twig->render('detail.html.twig', ['empleados' => $empleados]);
    }

}