<?php

use controllers\EstudianteController;
use models\Estudiante;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/estudiante.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/estudiante_controller.php';

$estudianteController = new EstudianteController();

$request = [
    'codigo' => $_POST['codigo'],
    'nombres' => $_POST['nombres'],
    'apellidos' => $_POST['apellidos'],
    'edad' => $_POST['edad'],
];

$estado = empty($_POST['id']) ? $estudianteController->create($request) : $estudianteController->update($_POST['id'], $request);
$url = 'index.php?page=estudiantes';
if ($estado != 'Registro actualizado' &&  !empty($_POST['id'])) {
    $url .= '&view=form&id=' . $_POST['id'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro guardado</title>
</head>

<body>
    <div>
        <h1>Resultado de la operación</h1>
        <p>
            <?php echo $estado; ?>
        </p>
        <a href="<?php echo  $url; ?>">Volver</a>
    </div>
</body>

</html>