<?php
$studentID = (isset($params[5])) ? $params[5] : null;

$school = $schools->find($schoolID);

if($school){
	require 'view/school/school/edit/edit.php';
} else {
	require 'view/school/error/404.php';
}