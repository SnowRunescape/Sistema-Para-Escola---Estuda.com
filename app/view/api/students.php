<?php
require_once 'controller/Students.class.php';

$studentsPage = (isset($params[3])) ? $params[3] : null;

$paramsLocal = "view/api/students/{$studentsPage}.php";

$students = new Students();

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
