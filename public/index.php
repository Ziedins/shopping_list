<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
const APP = ROOT . 'app' . DIRECTORY_SEPARATOR;

require APP . 'config/config.php';
require APP . 'core/application.php';

$app = new Application();

