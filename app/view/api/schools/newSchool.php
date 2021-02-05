<?php
require_once 'controller/Schools.class.php';

require_once 'model/SchoolFormModel.php';

$formModel = new SchoolFormModel();
$formModel->load($_POST);

if($formModel->validate()){
	$schools = new Schools();
	
	try {
		if($schools->register($formModel)){
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Escola cadastrada com sucesso!'
				]
			];
		} else {
			$response = [
				'status' => 500,
				'd' => [
					'message' => 'Ocorreu um erro, tente novamente mais tarde!'
				]
			];
		}
	} catch(Exception $e){
		$response = [
			'status' => 500,
			'd' => [
				'message' => 'Ocorreu um erro, tente novamente mais tarde!'
			]
		];
	}
} else {
	$response = [
		'status' => 400,
		'd' => [
			'message' => array_values($formModel->getErrors())[0]
		]
	];
}
