<?php
header('Content-Type: application/json');

$apiPage = $page = $params[2] ?: null;

$paramsLocal = "view/api/{$apiPage}.php";

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

echo json_encode($response['d'], JSON_UNESCAPED_UNICODE);

http_response_code($response['status']);
