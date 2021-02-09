<?php
require_once 'controller/Students.class.php';

$students = new Students();

$studentsPage = (isset($params[4])) ? $params[4] : 'students';

$paramsLocal = "view/school/students/{$studentsPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/school/error/404.php';
}
