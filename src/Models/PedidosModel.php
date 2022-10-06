<?php

namespace src\Models;

use src\Core\Connection;
use \PDO;
use \PDOException;

class PedidosModel extends Connection
{

    private $pedidos = [];

    function __construct()
    {
        parent::__construct();
    }

    function getAllPedidos()
    {
        $sql = "SELECT * FROM emp;";
        $stmt = $this->conn->query($sql);
        $this->setPedidos($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->getPedidos();
    }

    // GETTERS & SETTERS
    function setPedidos($pedidos){
        $this->pedidos = $pedidos;
    }

    function getPedidos(){
        return $this->pedidos;
    }
}
