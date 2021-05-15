<?php

namespace controllers;

use controllers\BaseController;
use models\Autor;

class AutorController extends BaseController
{
    public function index()
    {
        $model = new Autor();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Autor();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Autor();
        $data = $modelValidation->where([
            ['codigo', '=', $request['codigo']]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Autor();
        $model->set('nombres', $request['nombres']);
        $model->set('apellidos',  $request['apellidos']);
        $model->set('edad',  $request['edad']);
        $model->set('codigo',  $request['codigo']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Autor();
        $data = $modelValidation->where([
            ['codigo', '=', $request['codigo']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Autor();
        $model->set('id', $id);
        $model->set('nombres', $request['nombres']);
        $model->set('apellidos',  $request['apellidos']);
        $model->set('edad',  $request['edad']);
        $model->set('codigo',  $request['codigo']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Autor();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
