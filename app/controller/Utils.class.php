<?php
class Utils {
	public static function validatePhone($phone){
		$phone = preg_replace('/[()]/', '', $phone);
		
		if(preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([0-0]?[0-9]{1}[0-9]{1})\)?\s?)??(?:((?:9\d|[2-9])\d{3}\-?\d{4}))$/', $phone, $matches) == false){
			return false;
		}
		
		return true;
	}
}
