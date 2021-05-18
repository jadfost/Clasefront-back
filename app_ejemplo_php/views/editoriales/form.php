<?php

use controllers\AutorController;
use models\autor;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/autor.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/autor_controller.php';

$autorController = new AutorController();
$autor = empty($_GET['id']) ? new Autor() : $autorController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar estudiante' : 'Modificar estudiante';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=autores">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=autores&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $autor->get('id') . '">';
            }
            ?>

            <div>
                <label>Nombres:</label>
                <input name="nombre" id="nombre" type="text" value="<?php echo $autor->get('nombre'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>