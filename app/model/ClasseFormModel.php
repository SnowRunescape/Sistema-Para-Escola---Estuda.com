<?php
require_once 'controller/abstract/FormModel.php';

class ClasseFormModel extends FormModel {
	public $school_id;
	public $education_level;
	public $series;
	public $period;
	
	public function load($data){
		$this->school_id = trim($data['school_id']);
		$this->education_level = trim($data['education_level']);
		$this->series = trim($data['series']);
		$this->period = trim($data['period']);
	}
	
	public function validate(){
		if(strlen($this->school_id) == 0){
			$this->addError('school_id', 'Selecione a Escola da Turma.');
			return false;
		} else if(strlen($this->education_level) == 0){
			$this->addError('education_level', 'Selecione o Nível de Ensino da Turma.');
			return false;
		} else if(strlen($this->series) == 0){
			$this->addError('series', 'Selecione a Série da Turma.');
			return false;
		} else if(strlen($this->period) == 0){
			$this->addError('period', 'Selecione o Periodo da Turma.');
			return false;
		} else if(!array_key_exists($this->education_level, Classes::EDUCATION_LEVEL)){
			$this->addError('education_level', 'Nível de Ensino informado é invalido.');
			return false;
		} else if(!array_key_exists($this->series, Classes::SERIES[$this->education_level])){
			$this->addError('series', 'Série da Turma informado é invalido.');
			return false;
		} else if(!array_key_exists($this->period, Classes::PERIOD)){
			$this->addError('period', 'Periodo da Turma informado é invalido.');
			return false;
		}
		
		return true;
	}
}