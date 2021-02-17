<?php
require_once 'controller/Students.class.php';
require_once 'model/StudentFormModel.php';

$studentsAction = (isset($params[3])) ? $params[3] : null;

$students = new Students();

try {
	if($studentsAction == 'all'){
		if(isset($_POST['school_id'])){
			$schoolID = trim($_POST['school_id']);
			
			$response = [
				'status' => 200,
				'd' => [
					'students' => $students->all($schoolID)
				]
			];
		}
	} else if($studentsAction == 'newStudent'){
		$formModel = new StudentFormModel();
		$formModel->load($_POST);
		
		if($formModel->validate()){
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
		} else {
			$response = [
				'status' => 400,
				'd' => [
					'message' => array_values($formModel->getErrors())[0]
				]
			];
		}
	} else if($studentsAction == 'editStudent'){
		$formModel = new StudentFormModel();
		$formModel->load($_POST);
		
		if(isset($_POST['student_id'])){
			$studentID = trim($_POST['student_id']);
			
			if($formModel->validate()){
				$students->edit($studentID, $formModel);
				
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Informações do aluno modificado com sucesso!',
						'redirect' => "/school/{$formModel->school_id}/students"
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
	} else if($studentsAction == 'deleteStudent'){
		if(isset($_POST['student_id'])){
			$studentID = trim($_POST['student_id']);
			
			$students->remove($studentID);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Aluno deletado com sucesso!'
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
