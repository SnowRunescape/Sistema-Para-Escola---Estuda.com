<?php
require_once 'controller/abstract/FormModel.php';

class ClassesFormModel extends FormModel {
	public $education_level;
	public $series;
	public $shift;
	
	public function load($data){
		$this->education_level = trim($data['education_level']);
		$this->series = trim($data['series']);
		$this->shift = trim($data['shift']);
	}
	
	public function validate(){
		if(strlen($this->education_level) == 0){
			$this->addError('name', 'Informe o Nome da Escola.');
			return false;
		} else if(strlen($this->series) == 0){
			$this->addError('email', 'Informe o Endereço da Escola.');
			return false;
		} else if(strlen($this->shift) == 0){
			$this->addError('email', 'Informe o Endereço da Escola.');
			return false;
		}
		
		return true;
	}
}