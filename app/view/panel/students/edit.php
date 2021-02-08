<?php
$studentID = (isset($params[4])) ? $params[4] : null;

$student = $students->find($studentID);

if($student){
	require 'view/panel/students/edit/edit.php';
} else {
	require 'view/panel/error/404.php';
}