<?php

use controllers\SubtemaController;
use models\subtema;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/subtema.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/subtema_controller.php';

$subtemacontroller = new SubtemaController();
$subtema = empty($_GET['id']) ? new subtema() : $subtemacontroller->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar SubTema' : 'Modificar SubTema';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=subtemas">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=subtemas&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $subtema->get('id') . '">';
            }
            ?>

            <div>
                <label>Nombres:</label>
                <input name="nombre" id="nombre" type="text" value="<?php echo $subtema->get('nombre'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>