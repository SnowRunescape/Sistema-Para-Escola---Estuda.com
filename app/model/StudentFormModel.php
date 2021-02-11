<?php
require_once 'controller/abstract/FormModel.php';

class StudentFormModel extends FormModel {
	public $name;
	public $email;
	public $phone;
	public $birthday;
	public $genre;
	public $school_id;
	
	public function load($data){
		$this->name = ucwords(strtolower(trim($data['name'])));
		$this->email = trim($data['email']);
		$this->phone = trim($data['phone']);
		$this->birthday = trim($data['birthday']);
		$this->genre = trim($data['genre']);
		$this->school_id = trim($data['school_id']);
	}
	
	public function validate(){
		$schools = new Schools();
		
		if(strlen($this->name) == 0){
			$this->addError('name', 'Informe o Nome do aluno.');
			return false;
		} else if(strlen($this->email) == 0){
			$this->addError('email', 'Informe o E-mail do aluno.');
			return false;
		} else if(strlen($this->phone) == 0){
			$this->addError('phone', 'Informe o Telefone do aluno.');
			return false;
		} else if(strlen($this->birthday) == 0){
			$this->addError('birthday', 'Informe a Data de Nascimento do aluno.');
			return false;
		} else if(strlen($this->genre) == 0){
			$this->addError('genre', 'Informe o Gênero do aluno.');
			return false;
		} else if(strlen($this->school_id) == 0){
			$this->addError('school_id', 'Informe o ID da Escola.');
			return false;
		} else if(preg_match('/[^a-zA-Z\wÀ-ú ]/', $this->name)){
			$this->addError('name', 'Nome informado contem caractere invalido!');
			return false;
		} else if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
			$this->addError('email', 'E-mail informado é inválido!');
			return false;
		} else if(!Utils::validatePhone($this->phone)){
			$this->addError('phone', 'Telefone informado é inválido!');
			return false;
		} else if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->birthday)){
			$this->addError('birthday', 'Data de Nascimento informado é inválido!');
			return false;
		} else if(!array_key_exists($this->genre, Students::GENRE)){
			$this->addError('genre', 'Genero informado é invalido.');
			return false;
		} else if($schools->find($this->school_id) === false){
			$this->addError('school_id', 'ID da Escola informado é invalido.');
			return false;
		}
		
		return true;
	}
}