<?php

namespace controllers;

use controllers\BaseController;
use models\Estudiante;

class EstudianteController extends BaseController
{
    public function index()
    {
        $model = new Estudiante();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Estudiante();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Estudiante();
        $data = $modelValidation->where([
            ['codigo', '=', $request['codigo']]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Estudiante();
        $model->set('nombres', $request['nombres']);
        $model->set('apellidos',  $request['apellidos']);
        $model->set('edad',  $request['edad']);
        $model->set('codigo',  $request['codigo']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Estudiante();
        $data = $modelValidation->where([
            ['codigo', '=', $request['codigo']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El código ya se cuentra registrado";
        }

        $model = new Estudiante();
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
        $model = new Estudiante();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
