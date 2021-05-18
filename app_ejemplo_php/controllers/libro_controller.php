<?php

namespace controllers;

use controllers\BaseController;
use models\Libro;

class LibroController extends BaseController
{
    public function index()
    {
        $model = new Libro();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Libro();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Libro();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['descripcion', '=', $request['descripcion']],
            ['fecha_publicacion', '=', $request['fecha_publicacion']],
            ['edicion', '=', $request['edicion']],
            ['editorial_id', '=', $request['editorial_id']]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se cuentra registrado";
        }

        $model = new Libro();
        $model->set('nombre', $request['nombre']);
        $model->set('descripcion', $request['descripcion']);
        $model->set('fecha_publicacion', $request['fecha_publicacion']);
        $model->set('edicion', $request['edicion']);
        $model->set('editorial_id', $request['editorial_id']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Libro();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['descripcion', '=', $request['descripcion']],
            ['fecha_publicacion', '=', $request['fecha_publicacion']],
            ['edicion', '=', $request['edicion']],
            ['editorial_id', '=', $request['editorial_id']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se cuentra registrado";
        }

        $model = new Libro();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Libro();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
