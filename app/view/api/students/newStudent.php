<?php
require_once 'model/StudentFormModel.php';

$formModel = new StudentFormModel();
$formModel->load($_POST);

if($formModel->validate()){
	try {
		if($students->register($formModel)){
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Aluno cadastrado com sucesso!',
					'redirect' => "/school/{$formModel->school_id}/students"
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
