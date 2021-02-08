<?php
require_once 'controller/Students.class.php';

$students = new Students();

$studentsPage = (isset($params[3])) ? $params[3] : 'students';

$paramsLocal = "view/panel/students/{$studentsPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/panel/error/404.php';
}
