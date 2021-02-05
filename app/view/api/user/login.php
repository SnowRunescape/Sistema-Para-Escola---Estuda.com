<?php
require_once 'controller/Auth.class.php';

if(isset($_POST['email'], $_POST['password'])){
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	$Auth = new Auth();
	
	if(!$user->sessionIsOpened()){
		if($Auth->login($email, $password)){
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Usuario logado com sucesso!'
				]
			];
		} else {
			$response = [
				'status' => 400,
				'd' => [
					'message' => 'Usuario ou senha incorreto!'
				]
			];
		}
	} else {
		$response = [
			'status' => 400,
			'd' => [
				'message' => 'Você ja está logado!'
			]
		];
	}
} else {
	$response = [
		'status' => 400,
		'd' => [
			'message' => 'Bad Request'
		]
	];
}
