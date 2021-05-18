<?php

use controllers\LibroController;
use models\Libro;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/libro.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/libro_controller.php';

$libroController = new LibroController();

$request = [
    'nombre' => $_POST['nombre'],
    'descripcion' => $_POST['descripcion'],
    'fecha_publicacion' => $_POST['fecha_publicacion'],
    'edicion' => $_POST['edicion'],
    'editorial_id' => $_POST['editorial_id'],
];

$estado = empty($_POST['id']) ? $libroController->create($request) : $libroController->update($_POST['id'], $request);
$url = 'index.php?page=libros';
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