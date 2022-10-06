<?php

namespace src\Models;

use src\Core\Connection;
use \PDO;
use \PDOException;

class DepartamentosModel extends Connection
{

    private $departamentos = [];

    function __construct()
    {
        parent::__construct();
    }

    function getAllDepartamentos()
    {
        $sql = "SELECT * FROM dept;";
        $stmt = $this->conn->query($sql);
        $this->setDepartamentos($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->getDepartamentos();
    }

    // GETTERS & SETTERS
    function setDepartamentos($departamentos){
        $this->departamentos = $departamentos;
    }

    function getDepartamentos(){
        return $this->departamentos;
    }
}
