<?php

namespace  db;

use mysqli;

class ConexionDB
{
    private $servidor = '127.0.0.1';
    private $nombreDB = 'clase_prueba_db';
    private $usuarioDB = 'root';
    private $passwordDB = '1234';

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servidor, $this->usuarioDB, $this->passwordDB, $this->nombreDB);
    }

    public function getReturnSQL($sql)
    {
        return $this->conn->query($sql);
    }

    public function close()
    {
        $this->conn->close();
    }
}
