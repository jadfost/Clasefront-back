<?php

use controllers\EditorialController;
use models\Editorial;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/editorial.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/editorial_controller.php';

$editorialController = new EditorialController();

$request = [
    'nombre' => $_POST['nombre'],
];

$estado = empty($_POST['id']) ? $editorialController->create($request) : $editorialController->update($_POST['id'], $request);
$url = 'index.php?page=editoriales';
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