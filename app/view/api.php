<?php
header('Content-Type: application/json');

$apiPage = isset($params[2]) ? $params[2] : null;

$paramsLocal = "view/api/{$apiPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
}

if(!isset($response)){
	$response = [
		'status' => 400,
		'd' => [
			'message' => 'Bad Request'
		]
	];
}

echo json_encode($response['d'], JSON_UNESCAPED_UNICODE);

http_response_code($response['status']);
