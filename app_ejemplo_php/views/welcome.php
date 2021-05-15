<?php

require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once  dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/models/estudiante.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/controllers/estudiante_controller.php';

use controllers\EstudianteController;


$estudianteController = new EstudianteController();
$estudiantes =  $estudianteController->index();
foreach ($estudiantes as $item) {
    echo  $item->get('codigo'), ' ', $item->get('nombres'), '<br/>';
}

// $estudiante =  $estudianteController->detail(6);
// echo '<br/>', $estudiante->get('nombres'), '<br/>';

// $status = $estudianteController->create([
//     'nombres' => 'Test',
//     'apellidos' => 'Test 2',
//     'edad' => 26,
//     'codigo' => '9999'
// ]);

// echo '<br>', $status, '<br>';




$status = $estudianteController->update(29, [
    'nombres' => 'Test',
    'apellidos' => 'Test 2',
    'edad' => 30,
    'codigo' => '9999'
]);

echo '<br>', $status, '<br>';

$status = $estudianteController->delete(29);

echo '<br>', $status, '<br>';


// require_once('models/estudiante.php');

// $estudiante = new Estudiante();

// $estudiantes =  $estudiante->all();

// foreach ($estudiantes as $item) {
//     echo  $item->get('codigo'), ' ', $item->get('nombres'), '<br/>';
// }

// $rowEstudiante = new Estudiante();
// $result = $rowEstudiante->find(14);
// echo $result->get('apellidos'), '<br/>';


// $estudiante = new Estudiante();
// $estudiantes =  $estudiante->where([
//     ['nombres', 'like', '%J%'],
//     ['edad', '>', 18],
// ], 'or');

// foreach ($estudiantes as $item) {
//     echo  $item->get('codigo'), ' ', $item->get('nombres'), '<br/>';
// }

// echo empty($estudiantes) ? 'No hay datos' : '';


// $estudiante = new Estudiante();
// $estudiante->set('nombres', 'Maria');
// $estudiante->set('apellidos', 'Perez');
// $estudiante->set('edad', 25);
// $estudiante->set('codigo', '5555');
// $status = $estudiante->save();
// echo $status ? 'Datos registrados' : 'No hay datos registrados';

// $estudiante = new Estudiante();
// $estudiante->set('id', 28);
// $estudiante->set('nombres', 'Maria Test');
// $estudiante->set('apellidos', 'Perez');
// $estudiante->set('edad', 22);
// $estudiante->set('codigo', '11111');
// $status = $estudiante->update();
// echo $status ? 'Datos actualizados' : 'No hay datos actualizados';

// $estudiante = new Estudiante();
// $estudiante->set('id', 28);
// $status = $estudiante->delete();
// echo $status ? 'Datos eliminados' : 'No hay datos eliminados';
