<?php
$studentsPage = (isset($params[3])) ? $params[3] : null;

$paramsLocal = __DIR__ . "/students/{$studentsPage}.php";

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
