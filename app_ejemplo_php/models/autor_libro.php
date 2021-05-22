<?php

namespace models;

use models\Model;

class AutorLibro extends Model
{
    protected $libro_id;
    protected $autor_id;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'autores_libros';
    }
}
