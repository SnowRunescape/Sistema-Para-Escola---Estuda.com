<?php
if(isset($_POST['school_id'])){
	$schoolID = trim($_POST['school_id']);
	
	try {
		$response = [
			'status' => 200,
			'd' => [
				'students' => $students->all($schoolID)
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
