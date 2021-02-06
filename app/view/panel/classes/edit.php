<?php
$classeID = (isset($params[4])) ? $params[4] : null;

$classe = $classes->find($classeID);

if($classe){
	require 'view/panel/classes/edit/edit.php';
} else {
	require 'view/panel/error/404.php';
}