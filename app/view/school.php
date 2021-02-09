<?php
require 'controller/Students.class.php';
require 'controller/Classes.class.php';

$schoolID = ((isset($params[2])) && (!empty($params[2]))) ? $params[2] : null;

$students = new Students();
$classes = new Classes();

$school = $schools->find($schoolID);

if($school){
	$panelPage = ((isset($params[3])) && (!empty($params[3]))) ? $params[3] : 'dashboard';

	$paramsLocal = "view/school/{$panelPage}.php";

	if(file_exists($paramsLocal)){
		require $paramsLocal;
	} else {
		require 'view/school/error/404.php';
	}
} else {
	require 'view/error/404.php';
}
