<?php
require_once 'controller/abstract/FormModel.php';

class SchoolFormModel extends FormModel {
	public $name;
	public $andress;
	
	public function load($data){
		$this->name = trim($data['name']);
		$this->andress = trim($data['andress']);
	}
	
	public function validate(){
		if(strlen($this->name) == 0){
			$this->addError('name', 'Informe o Nome da Escola.');
			return false;
		} else if(strlen($this->andress) == 0){
			$this->addError('email', 'Informe o Endereço da Escola.');
			return false;
		}
		
		return true;
	}
}