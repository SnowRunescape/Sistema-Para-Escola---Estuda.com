<?php
class User {
	private $user;
	
	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
		
		if(isset($_SESSION['user'])){
			$this->user = $_SESSION['user'];
		}
	}
	
	public function openSession($user){
		$this->user = $_SESSION['user'] = $user;
	}
	
	public function destroySession(){
		session_destroy();
	}
	
	public function sessionIsOpened(){
		if(!empty($this->user)) return true;
		
		return false;
	}
}
