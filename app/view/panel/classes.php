<?php
require_once 'controller/Classes.class.php';

$classes = new Classes();

$classesPage = (isset($params[3])) ? $params[3] : 'classes';

$paramsLocal = "view/panel/classes/{$classesPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/panel/error/404.php';
}
