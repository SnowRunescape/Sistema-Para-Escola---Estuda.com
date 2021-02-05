<?php
class DB {
	private static $connection;
	
	public static function conn(){
		try {
			if(is_null(self::$connection)){
				self::$connection = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
				self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch(PDOException $e){
			require 'view/error/500.php';
			exit;
		}
		
		return self::$connection;
	}
}
