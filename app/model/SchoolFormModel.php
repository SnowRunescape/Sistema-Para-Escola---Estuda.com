<?php
require_once 'controller/abstract/FormModel.php';

class SchoolFormModel extends FormModel {
	public $name;
	public $andress;
	
	public function load($data){
		$this->name = trim($data['name']);
		$this->andress = trim($data['andress']);
		$this->status = trim($data['status']);
	}
	
	public function validate(){
		if(strlen($this->name) == 0){
			$this->addError('name', 'Informe o Nome da Escola.');
			return false;
		} else if(strlen($this->andress) == 0){
			$this->addError('andress', 'Informe o Endereço da Escola.');
			return false;
		} else if(!array_key_exists($this->status, Schools::STATUS)){
			$this->addError('status', 'Situação da Escola informado é invalido.');
			return false;
		}
		
		return true;
	}
}