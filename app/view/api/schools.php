<?php
require_once 'controller/Schools.class.php';
require_once 'model/SchoolFormModel.php';

$schoolsAction = (isset($params[3])) ? $params[3] : null;

$schools = new Schools();

try {
	if($schoolsAction == 'newSchool'){
		$formModel = new SchoolFormModel();
		$formModel->load($_POST);
		
		if($formModel->validate()){
			if($schools->register($formModel)){
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Escola cadastrada com sucesso!',
						'redirect' => '/'
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
		} else {
			$response = [
				'status' => 400,
				'd' => [
					'message' => array_values($formModel->getErrors())[0]
				]
			];
		}
	} else if($schoolsAction == 'editSchool'){
		$formModel = new SchoolFormModel();
		$formModel->load($_POST);

		if(isset($_POST['id'])){
			$schoolID = trim($_POST['id']);
			
			if($formModel->validate()){
				$schools->edit($schoolID, $formModel);
				
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Informações da escola modificada com sucesso!',
						'redirect' => "/school/{$schoolID}/"
					]
				];
			} else {
				$response = [
					'status' => 400,
					'd' => [
						'message' => array_values($formModel->getErrors())[0]
					]
				];
			}
		}
	} else if($schoolsAction == 'deleteSchool'){
		if(isset($_POST['school_id'])){
			$schoolID = trim($_POST['school_id']);
			
			$schools->remove($schoolID);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Escola deletada com sucesso!'
				]
			];
		}
	}
} catch(Exception $e){
	$response = [
		'status' => 500,
		'd' => [
			'message' => 'Ocorreu um erro, tente novamente mais tarde!'
		]
	];
}
