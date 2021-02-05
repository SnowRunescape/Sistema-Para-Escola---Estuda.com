<?php
class Auth {
	public function login($email, $password){
		$user = new User();
		
		if(!$user->sessionIsOpened()){
			try {
				$authSQL = DB::conn()->prepare('SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1');
				$authSQL->execute([
					':email' => $email,
					':password' => $password
				]);
				
				if($authSQL->rowCount() > 0){
					$user_fetch = $authSQL->fetch(PDO::FETCH_ASSOC);
					
					$user->openSession($user_fetch);
					
					return true;
				}
			} catch(PDOException $e){
				echo $e;
				return false;
			}
		}
		
		return false;
	}
}
