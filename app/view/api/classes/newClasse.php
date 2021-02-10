<?php
require_once 'model/ClasseFormModel.php';

$formModel = new ClasseFormModel();
$formModel->load($_POST);

if($formModel->validate()){
	try {
		if($classes->register($formModel)){
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Turma cadastrada com sucesso!',
					'redirect' => "/school/{$formModel->school_id}/classes"
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
