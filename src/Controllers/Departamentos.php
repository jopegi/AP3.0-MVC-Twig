<?php 

namespace src\Controllers;
use src\Models\DepartamentosModel;

class Departamentos {

    private $model;

    function __construct()
    {
        $this->model = new DepartamentosModel();
        print_r('Soy el controlador de Departamentos');
    }

    public function getDepartamentos()
    {
        $departamentos = $this->model->getDepartamentos();
        // echo $this->twig->render('detail.html.twig', ['departamentos' => $departamentos]);
    }

}