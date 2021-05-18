<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/autor.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/autor_controller.php';

use controllers\AutorController;

$autorController = new AutorController();
?>
<!doctype HTML>
<html>

<head>
    <title>Autores</title>
</head>

<body>
    <h1>Listado de Autores</h1>
    <a href="index.php?page=autores&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $autorController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('nombre'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=autores&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=autores&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="autor" id="autor">
        <?php
        $rows = $autorController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('nombre') . '</option>';
        }
        ?>
    </select>
</body>

</html>