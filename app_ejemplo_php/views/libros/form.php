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
$libro = empty($_GET['id']) ? new Libro() : $libroController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar estudiante' : 'Modificar estudiante';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=libros">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=libros&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $libro->get('id') . '">';
            }
            ?>
            <div>
                <label>Nombre:</label>
                <input name="Nombre" id="Nombre" type="text" value="<?php echo $libro->get('Nombre'); ?>" required>
            </div>
            <div>
                <label>Descripcion:</label>
                <input name="Descripcion" id="Descripcion" type="text" value="<?php echo $libro->get('Descripcion'); ?>" required>
            </div>
            <div>
                <label>Fecha_Publicacion:</label>
                <input name="Fecha_Publicacion" id="Fecha_Publicacion" type="text" value="<?php echo $libro->get('fecha_publicacion'); ?>" required>
            </div>
            <div>
                <label>Edicion:</label>
                <input name="Edicion" id="Edicion" type="text" value="<?php echo $libro->get('Edicion'); ?>" required>
            </div>
            <div>
                <label>Editorial_id:</label>
                <input name="Editorial_id" id="Editorial_id" type="number" value="<?php echo $libro->get('editorial_id'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>