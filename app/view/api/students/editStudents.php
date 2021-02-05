<?php
require_once 'model/StudentFormModel.php';

$formModel = new StudentFormModel();
$formModel->load($_POST);

if($formModel->validate()){
	$students = new Students();
	
	try {
		if($students->edit($formModel)){
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Informações do aluno modificado com sucesso!'
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
