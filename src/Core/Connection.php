<?php

/**
 * Clase de conexión a la BBDD
 */

namespace src\Core;

use \PDO;
use \PDOException;

class Connection
{
    protected $conn;
    public function __construct()
    {
        $rootPath = dirname(dirname(__FILE__), 2);
        $fichero = file_get_contents($rootPath . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "db.json");
        $datosDB = json_decode($fichero, true);

        $servername = $datosDB["host"];
        $username = $datosDB["user"];
        $password = $datosDB["password"];
        $db = $datosDB["database"];
        $port = $datosDB["port"];

        //Establece la conexión
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db;port=$port", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión a BBDD establecida!";
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    public function __destruct()
    {
        //cierra la conexión
        $this->conn = null;
    }
}
