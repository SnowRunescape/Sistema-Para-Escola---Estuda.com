<?php
require 'controller/Config.php';
require 'controller/Utils.class.php';
require 'controller/Connection.class.php';
require 'controller/Schools.class.php';

$schools = new Schools();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$params = explode('/', $path);

$page = $params[1] ?: 'index';
	
$paramsLocal = "view/{$page}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/error/404.php';
}