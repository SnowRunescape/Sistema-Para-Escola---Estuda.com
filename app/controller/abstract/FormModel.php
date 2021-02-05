<?php
abstract class FormModel {
	private $errors = [];

	public function addError($variable, $error){
		$this->errors[$variable] = $error;
	}

	public function getError($variable){
		return (isset($this->errors[$variable])) ? $this->errors[$variable] : '';
	}

	public function getErrors(){
		return $this->errors;
	}

	public abstract function load($data);
	public abstract function validate();
}
