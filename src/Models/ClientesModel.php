<?php

namespace src\Models;

use src\Core\Connection;
use src\Core\Interfaces\ClientesModelI;
use \PDO;
use \PDOException;

class ClientesModel extends Connection implements ClientesModelI 
{

    private $detalles = [];
    private $clientes = [];

    function __construct()
    {
        parent::__construct();
    }

    function getAllClientes()
    {
        $sql = "SELECT * FROM cliente;";
        $stmt = $this->conn->query($sql);
        $this->setClientes($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->getClientes();
    }

    function getDetallesCliente($id)
    {
        $sql = "SELECT * FROM cliente Where CLIENTE_COD = :id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $this->setDetalles($stmt->fetch(PDO::FETCH_ASSOC));
            
        }
        return $this->getDetalles();
    }

    // SETTERS & GETTERS
    function setDetalles($detalles)
    {
        $this->detalles = $detalles;
    }

    function getDetalles()
    {
        return $this->detalles;
    }

    function setClientes($clientes){
        $this->clientes = $clientes;
    }

    function getClientes(){
        return $this->clientes;
    }
}
