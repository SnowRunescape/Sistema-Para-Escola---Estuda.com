<?php
$panelPage = ((isset($params[2])) && (!empty($params[2]))) ? $params[2] : 'dashboard';

$paramsLocal = "view/panel/{$panelPage}.php";

if(file_exists($paramsLocal)){
	require $paramsLocal;
} else {
	require 'view/panel/error/404.php';
}