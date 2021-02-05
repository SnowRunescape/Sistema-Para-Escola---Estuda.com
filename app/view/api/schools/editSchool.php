<?php
require_once 'controller/Schools.class.php';

require_once 'model/SchoolFormModel.php';

$formModel = new SchoolFormModel();
$formModel->load($_POST);

if(isset($_POST['id'])){
	$schoolID = trim($_POST['id']);
	
	if($formModel->validate()){
		$schools = new Schools();
		
		try {
			$schools->edit($schoolID, $formModel);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Informações da escola modificada com sucesso!'
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
