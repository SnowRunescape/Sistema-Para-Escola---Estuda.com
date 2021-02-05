<?php
require_once 'controller/abstract/FormModel.php';

class StudentFormModel extends FormModel {
	public $name;
	public $email;
	public $phone;
	public $birthday;
	public $genre;
	
	public function load($data){
		$this->name = trim($data['name']);
		$this->email = trim($data['email']);
		$this->phone = trim($data['phone']);
		$this->birthday = trim($data['birthday']);
		$this->genre = trim($data['genre']);
	}
	
	public function validate(){
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
		} else if(preg_match('/[^a-zA-Z\wÀ-ú ]/', $this->name)){
			$this->addError('name', 'Nome informado contem caractere invalido!');
			return false;
		} else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
			$this->addError('email', 'E-mail informado é inválido!');
			return false;
		} else if(!Utils::validatePhone($this->phone)){
			$this->addError('phone', 'Telefone informado é inválido!');
			return false;
		} else if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->birthday)){
			$this->addError('birthday', 'Data de Nascimento informado é inválido!');
			return false;
		} else if((!filter_var($this->genre, FILTER_VALIDATE_INT)) || ($this->genre < 0) || ($this->genre > 1)){
			$this->addError('genre', 'Genero informado é inválido!');
			return false;
		}
		
		return true;
	}
}