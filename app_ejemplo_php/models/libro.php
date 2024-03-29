<?php

namespace models;

use models\Model;

class Libro extends Model
{
    protected $id;
    protected $nombre;
    protected $descripcion;
    protected $fecha_publicacion;
    protected $edicion;
    protected $editorial_id;

    //protected $tema_id;
    //protected $subtema_id;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'libros';
    }
}
