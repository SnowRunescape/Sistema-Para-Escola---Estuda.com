<?php
$schoolID = (isset($params[4])) ? $params[4] : null;

$school = $schools->find($schoolID);

if($school){
	require 'view/panel/schools/edit/edit.php';
} else {
	require 'view/panel/error/404.php';
}