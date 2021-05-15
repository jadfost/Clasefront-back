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
$estudiante = empty($_GET['id']) ? new Estudiante() : $estudianteController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar estudiante' : 'Modificar estudiante';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=estudiantes">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=estudiantes&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $estudiante->get('id') . '">';
            }
            ?>

            <div>
                <label>Código:</label>
                <input name="codigo" id="codigo" type="text" value="<?php echo $estudiante->get('codigo'); ?>" required>
            </div>
            <div>
                <label>Nombres:</label>
                <input name="nombres" id="nombres" type="text" value="<?php echo $estudiante->get('nombres'); ?>" required>
            </div>
            <div>
                <label>Apellidos:</label>
                <input name="apellidos" id="apellidos" type="text" value="<?php echo $estudiante->get('apellidos'); ?>" required>
            </div>
            <div>
                <label>Edad:</label>
                <input name="edad" id="edad" type="number" value="<?php echo $estudiante->get('edad'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>