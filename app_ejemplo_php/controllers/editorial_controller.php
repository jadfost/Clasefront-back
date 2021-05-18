<?php

namespace controllers;

use controllers\BaseController;
use models\Editorial;

class EditorialController extends BaseController
{
    public function index()
    {
        $model = new Editorial();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Editorial();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Editorial();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se cuentra registrado";
        }

        $model = new Editorial();
        $model->set('nombre', $request['nombre']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Editorial();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se cuentra registrado";
        }

        $model = new Editorial();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Editorial();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
