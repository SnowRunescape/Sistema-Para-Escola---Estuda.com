<?php
$schoolsPage = (isset($params[4])) ? $params[4] : 'classes';

$paramsLocal = "view/school/school/{$schoolsPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/school/error/404.php';
}
