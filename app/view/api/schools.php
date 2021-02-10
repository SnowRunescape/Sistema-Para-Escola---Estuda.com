<?php
require_once 'controller/Schools.class.php';

$schoolsPage = (isset($params[3])) ? $params[3] : null;

$paramsLocal = "view/api/schools/{$schoolsPage}.php";

$schools = new Schools();

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	$response = [
		'status' => 400,
		'd' => [
			'message' => 'Bad Request'
		]
	];
}
