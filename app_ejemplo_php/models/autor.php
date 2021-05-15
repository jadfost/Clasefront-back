<?php

namespace models;

use models\Model;

class Autor extends Model
{
    protected $id;
    protected $nombre;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'autores';
    }
}
