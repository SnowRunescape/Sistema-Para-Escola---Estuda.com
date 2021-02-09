<?php
$classeID = (isset($params[5])) ? $params[5] : null;

$classe = $classes->find($classeID);

if($classe){
	require 'view/school/classes/edit/edit.php';
} else {
	require 'view/school/error/404.php';
}