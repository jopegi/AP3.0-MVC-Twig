<?php

namespace src\Models;

use src\Core\Connection;
use \PDO;
use \PDOException;

class HomeModel extends Connection
{
    function __construct()
    {
        parent::__construct();
    }
}
