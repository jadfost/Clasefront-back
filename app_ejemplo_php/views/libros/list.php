<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/libro.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/libro_controller.php';

use controllers\LibroController;

$libroController = new LibroController();
?>
<!doctype HTML>
<html>

<head>
    <title>Libros</title>
</head>

<body>
    <h1>Listado de Libros</h1>
    <a href="index.php?page=libros&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Fecha_Publicacion</th>
                <th>Edicion</th>
                <th>Editorial_id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $libroController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('nombre'), '</td>';
                echo '  <td>', $row->get('descripcion'), '</td>';
                echo '  <td>', $row->get('fecha_Publicacion'), '</td>';
                echo '  <td>', $row->get('edicion'), '</td>';
                echo '  <td>', $row->get('editorial_id'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=libros&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=libros&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="libros" id="libros">
        <?php
        $rows = $libroController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('nombre') . '</option>';
        }
        ?>
    </select>
</body>

</html>