<?php
$studentID = (isset($params[5])) ? $params[5] : null;

$student = $students->find($studentID);

if($student){
	require 'view/school/students/edit/edit.php';
} else {
	require 'view/school/error/404.php';
}