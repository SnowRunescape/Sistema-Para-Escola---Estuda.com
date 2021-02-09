<?php
require_once 'controller/Classes.class.php';

$classes = new Classes();

$classesPage = (isset($params[4])) ? $params[4] : 'classes';

$paramsLocal = "view/school/classes/{$classesPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/school/error/404.php';
}
