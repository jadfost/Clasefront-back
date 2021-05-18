<?php
require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/api/parse_array_reponse.php';
require_once dirname(__DIR__) . '/api/response.php';

$uriRelativeApp =  '/clase/Clasefront-back/app_ejemplo_php/';

$uriClass = [
    "editoriales" => [
        'model' => 'models/editorial.php',
        'controller' => 'controllers/editorial_controller.php'
    ],

    "autores" => [
        'model' => 'models/autor.php',
        'controller' => 'controllers/autor_controller.php'
    ],
];

$controllers = [
    "editoriales" => 'controllers\EditorialController',

    "autores" => 'controllers\AutorController'
];


$getArrayUrlCurrent = function () {
    $urlData = str_replace($GLOBALS['uriRelativeApp'], '', $_SERVER['REQUEST_URI']);
    $urlArray  =  explode('/', $urlData);
    return  $urlArray;
};

