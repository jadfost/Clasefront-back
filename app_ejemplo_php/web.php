<?php

$fileHtml = "";
if (!empty($_GET['page'])) {
    $view = !empty($_GET['view']) ? $_GET['view'] : 'list';
    $fileHtml = "/app_ejemplo_php/views/$_GET[page]/$view.php";
} else {
    $fileHtml = '/app_ejemplo_php/views/welcome.php';
}

require_once dirname(__DIR__) . $fileHtml;