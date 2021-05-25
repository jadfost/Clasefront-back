<?php

namespace models;

use models\Model;

class LibroSubtema extends Model
{
    protected $libro_id;
    protected $sub_tema_id;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'libros_sub_temas';
    }
}
