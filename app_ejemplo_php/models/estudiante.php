<?php

namespace models;

use models\Model;

class Estudiante extends Model
{
    protected $id;
    protected $codigo;
    protected $nombres;
    protected $apellidos;
    protected $edad;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'estudiantes';
    }
}
