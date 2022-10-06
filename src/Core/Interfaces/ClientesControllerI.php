<?php 

namespace src\Core\Interfaces;

interface ClientesControllerI {

    public function getListaClientes();
    public function getDetalleCliente($id);
}