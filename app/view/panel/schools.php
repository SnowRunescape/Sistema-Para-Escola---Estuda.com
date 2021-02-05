<?php
require_once 'controller/Schools.class.php';

$schools = new Schools();

$schoolsPage = (isset($params[3])) ? $params[3] : 'schools';

$paramsLocal = "view/panel/schools/{$schoolsPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/panel/error/404.php';
}
