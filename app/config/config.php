<?php

const ENVIRONMENT = 'development';
const DATE_FORMAT = 'Y-m-d H:i:s';


ini_set("log_errors", 1);

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
} else {
    error_reporting(0);
    ini_set("display_errors", 0);
}

const URL_PUBLIC_FOLDER = 'public';
const URL_PROTOCOL = '//';
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
const URL = URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER;

require 'db.php';
