<?php

namespace src\Models;

use src\Core\Connection;
use \PDO;
use \PDOException;

class ProductosModel extends Connection
{

    private $productos = [];

    function __construct()
    {
        parent::__construct();
    }

    function getAllProductos()
    {
        $sql = "SELECT * FROM producto;";
        $stmt = $this->conn->query($sql);
        $this->setProductos($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $this->getProductos();
    }

    // GETTERS & SETTERS
    function setProductos($productos){
        $this->productos = $productos;
    }

    function getProductos(){
        return $this->productos;
    }
}
