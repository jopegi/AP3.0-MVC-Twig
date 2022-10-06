<?php 

namespace src\Core\Interfaces;

interface ClientesControllerI {

    public function clientes();
    public function getDetalleCliente($id);
}