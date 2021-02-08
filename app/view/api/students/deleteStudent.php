<?php
require_once 'controller/Students.class.php';

if(isset($_POST['student_id'])){
	$studentID = trim($_POST['student_id']);
	
	$students = new Students();
	
	try {
		$students->remove($studentID);
		
		$response = [
			'status' => 200,
			'd' => [
				'message' => 'Aluno deletado com sucesso!'
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
			'message' => 'Bad Request'
		]
	];
}
