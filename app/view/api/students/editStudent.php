<?php
require_once 'controller/Students.class.php';

require_once 'model/StudentFormModel.php';

$formModel = new StudentFormModel();
$formModel->load($_POST);

if(isset($_POST['student_id'])){
	$studentID = trim($_POST['student_id']);
	
	if($formModel->validate()){
		$students = new Students();
		
		try {
			$students->edit($studentID, $formModel);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Informações do aluno modificado com sucesso!',
					'redirect' => "/school/{$formModel->school_id}/students"
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
}
