<?php
require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/api/parse_array_reponse.php';
require_once dirname(__DIR__) . '/api/response.php';

$uriRelativeApp =  '/clase/app_ejemplo_php/';

$uriClass = [
    "estudiantes" => [
        'model' => 'models/estudiante.php',
        'controller' => 'controllers/estudiante_controller.php'
    ],
    "docentes" => [
        'model' => 'models/docente.php',
        'controller' => 'controllers/docente_controller.php'
    ],
];

$controllers = [
    "estudiantes" => 'controllers\EstudianteController',
    "decentes" => 'controllers\DocenteController'
];


$getArrayUrlCurrent = function () {
    $urlData = str_replace($GLOBALS['uriRelativeApp'], '', $_SERVER['REQUEST_URI']);
    $urlArray  =  explode('/', $urlData);
    return  $urlArray;
};

