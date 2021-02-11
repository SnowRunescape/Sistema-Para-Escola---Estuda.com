<?php
$classeID = (isset($params[5])) ? $params[5] : null;

$classe = $classes->find($classeID);

if($classe){
	$classesPage = ((isset($params[6])) && (!empty($params[6]))) ? $params[6] : 'edit';
	
	$paramsLocal = "view/school/classes/edit/{$classesPage}.php";
	
	if(file_exists($paramsLocal)){
		require $paramsLocal;
	} else {
		require 'view/school/error/404.php';
	}
} else {
	require 'view/school/error/404.php';
}