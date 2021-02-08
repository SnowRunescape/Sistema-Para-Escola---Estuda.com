<?php
require_once 'controller/Classes.class.php';

if(isset($_POST['classe_id'])){
	$classeID = trim($_POST['classe_id']);
	
	$classes = new Classes();
	
	try {
		$classes->remove($classeID);
		
		$response = [
			'status' => 200,
			'd' => [
				'message' => 'Turma deletada com sucesso!'
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
