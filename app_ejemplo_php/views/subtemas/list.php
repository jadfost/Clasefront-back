<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/subtema.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/subtema_controller.php';

use controllers\SubtemaController;

$subtemacontroller = new SubtemaController();
?>
<!doctype HTML>
<html>

<head>
    <title>Temas</title>
</head>

<body>
    <h1>Listado de SubTemas</h1>
    <a href="index.php?page=subtemas&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $subtemacontroller->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('nombre'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=subtemas&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=subtemas&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="subtema" id="subtema">
        <?php
        $rows = $subtemacontroller->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('nombre') . '</option>';
        }
        ?>
    </select>
</body>

</html>