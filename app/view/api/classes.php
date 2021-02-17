<?php
require_once 'controller/Classes.class.php';
require_once 'model/ClasseFormModel.php';

$classesAction = (isset($params[3])) ? $params[3] : null;

$classes = new Classes();

try {
	if($classesAction == 'newClasse'){
		$formModel = new ClasseFormModel();
		$formModel->load($_POST);

		if($formModel->validate()){
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
		} else {
			$response = [
				'status' => 400,
				'd' => [
					'message' => array_values($formModel->getErrors())[0]
				]
			];
		}
	} else if($classesAction == 'editClasse'){
		$formModel = new ClasseFormModel();
		$formModel->load($_POST);

		if(isset($_POST['classe_id'])){
			$classeID = trim($_POST['classe_id']);
			
			if($formModel->validate()){
				$classes->edit($classeID, $formModel);
				
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Informações da turma modificada com sucesso!',
						'redirect' => "/school/{$formModel->school_id}/classes"
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
	} else if($classesAction == 'addStudent'){
		if(isset($_POST['class_id'], $_POST['student_id'])){
			$studentID = trim($_POST['student_id']);
			$classID = trim($_POST['class_id']);
			
			if($classes->addStudent($classID, $studentID)){
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Aluno adicionado com sucesso!'
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
		}
	} else if($classesAction == 'deleteClasse'){
		if(isset($_POST['classe_id'])){
			$classeID = trim($_POST['classe_id']);
			
			$classes->remove($classeID);
			
			$response = [
				'status' => 200,
				'd' => [
					'message' => 'Turma deletada com sucesso!'
				]
			];
		}
	} else if($classesAction == 'deleteStudent'){
		if(isset($_POST['class_id'], $_POST['student_id'])){
			$studentID = trim($_POST['student_id']);
			$classID = trim($_POST['class_id']);
			
			if($classes->removeStudent($classID, $studentID)){
				$response = [
					'status' => 200,
					'd' => [
						'message' => 'Aluno deletado com sucesso!'
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
