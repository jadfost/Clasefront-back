<?php

$conf = 'api';

$fileHtml = $conf == 'api' ? '/app_ejemplo_php/api.php' : '/app_ejemplo_php/web.php';
require_once dirname(__DIR__) . $fileHtml;
