<?php
$userPage = $params[3] ?: null;

$paramsLocal = __DIR__ . "/user/{$userPage}.php";

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
