<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/estudiante.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/estudiante_controller.php';

use controllers\EstudianteController;

$estudianteController = new EstudianteController();
?>
<!doctype HTML>
<html>

<head>
    <title>Estudiantes</title>
</head>

<body>
    <h1>Listado de estudiantes</h1>
    <a href="index.php?page=estudiantes&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $estudianteController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('codigo'), '</td>';
                echo '  <td>', $row->get('nombres'), ' ', $row->get('apellidos'), '</td>';
                echo '  <td>', $row->get('edad'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=estudiantes&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=estudiantes&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="estudiante" id="estudiante">
        <?php
        $rows = $estudianteController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('nombres') . '</option>';
        }
        ?>
    </select>
</body>

</html>