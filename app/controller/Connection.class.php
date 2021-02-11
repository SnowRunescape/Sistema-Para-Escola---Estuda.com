<?php
class DB {
	/*
	 * Conexão com o mysql
	 */
	private static $connection;
	
	/*
	 * Retorna a conexão com o mysql
	 * @return PDO
	 */
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
