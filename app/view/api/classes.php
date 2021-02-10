<?php
require_once 'controller/Classes.class.php';

$classesPage = (isset($params[3])) ? $params[3] : null;

$paramsLocal = "view/api/classes/{$classesPage}.php";

$classes = new Classes();

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
