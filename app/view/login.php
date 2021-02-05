<?php
if($user->sessionIsOpened()){
	header('location: /panel');
} else {
	require 'view/login/login.php';
}
