<?php
require_once 'controller/Classes.class.php';

require_once 'model/ClasseFormModel.php';

$formModel = new ClasseFormModel();
$formModel->load($_POST);

if(isset($_POST['classe_id'])){
	$classeID = trim($_POST['classe_id']);
	
	if($formModel->validate()){
		try {
			$classes->edit($classeID, $formModel);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Informações da turma modificada com sucesso!',
					'redirect' => "/school/{$formModel->school_id}/classes"
				]
			];
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
} else {
	$response = [
		'status' => 400,
		'd' => [
			'message' => 'Bad Request'
		]
	];
}
