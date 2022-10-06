<?php

namespace src\Models;

use src\Core\Connection;
use \PDO;
use \PDOException;

class EmpleadosModel extends Connection
{

    private $empleados = [];

    function __construct()
    {
        parent::__construct();
    }

    function getAllEmpleados()
    {
        $sql = "SELECT * FROM emp;";
        $stmt = $this->conn->query($sql);
        $this->setEmpleados($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->getEmpleados();
    }

    // GETTERS & SETTERS
    function setEmpleados($empleados){
        $this->empleados = $empleados;
    }

    function getEmpleados(){
        return $this->empleados;
    }
}
