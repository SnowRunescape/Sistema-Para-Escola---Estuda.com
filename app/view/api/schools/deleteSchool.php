<?php
require_once 'controller/Schools.class.php';

require_once 'model/SchoolFormModel.php';

$formModel = new SchoolFormModel();
$formModel->load($_POST);

if(isset($_POST['id'])){
	$schoolID = trim($_POST['id']);
	
	$schools = new Schools();
	
	try {
		$schools->remove($schoolID);
		
		$response = [
			'status' => 200,
			'd' => [
				'message' => 'Escola deletada com sucesso!'
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
