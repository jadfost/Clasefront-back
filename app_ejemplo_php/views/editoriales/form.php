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
$editorial = empty($_GET['id']) ? new Editorial() : $editorialController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar Editorial' : 'Modificar Editorial';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=editoriales">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=editoriales&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $editorial->get('id') . '">';
            }
            ?>

            <div>
                <label>Nombres:</label>
                <input name="nombre" id="nombre" type="text" value="<?php echo $editorial->get('nombre'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>