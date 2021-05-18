<?php

use controllers\TemaController;
use models\Tema;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/tema.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/tema_controller.php';

$temaController = new TemaController();
$tema = empty($_GET['id']) ? new Tema() : $temaController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar Tema' : 'Modificar Tema';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=temas">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=temas&view=save" method="POST">
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