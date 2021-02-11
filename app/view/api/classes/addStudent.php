<?php
if(isset($_POST['class_id'], $_POST['student_id'])){
	$studentID = trim($_POST['student_id']);
	$classID = trim($_POST['class_id']);
	
	try {
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
			'message' => 'Bad Request'
		]
	];
}
