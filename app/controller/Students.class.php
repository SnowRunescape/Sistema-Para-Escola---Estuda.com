<?php
require_once 'controller/ClassStudents.class.php';

class Students {
	/*
	 * Variaveis constantes responsaveis por definir o conteudo
	 * e filtrar os dados que estão sendo enviado dos formularios
	 */
	const GENRE = [
		0 => 'Masculino',
		1 => 'Feminino'
	];
	
	/*
	 * Retorna todas as Alunos de uma Escola especifica
	 * @param Integer $school_id
	 * @return Array
	 */
	public function all($school_id = null){
		$students = [];
		
		$sql = ($school_id === null) ? 'SELECT * FROM students' : 'SELECT * FROM students WHERE school_id = :school_id';
		
		$studentsSQL = DB::conn()->prepare($sql);
		$studentsSQL->execute([
			':school_id' => $school_id
		]);
		
		while($student = $studentsSQL->fetch(PDO::FETCH_OBJ)){
			$schools = new Schools();
			
			$student->school = $schools->find($student->school_id);
			
			$students[] = $student;
		}
		
		return $students;
	}
	
	/*
	 * Retorna o numero de Alunos de uma Escola especifica
	 * @param Integer $school_id
	 * @return Integer
	 */
	public function count($school_id = null){
		$sql = ($school_id === null) ? 'SELECT count(*) FROM students' : 'SELECT count(*) FROM students WHERE school_id = :school_id';
		
		$studentsSQL = DB::conn()->prepare($sql);
		$studentsSQL->execute([
			':school_id' => $school_id
		]);
		
		return $studentsSQL->fetchColumn();
	}
	
	/*
	 * Metodo responsavel por registrar um novo Aluno
	 * @param StudentFormModel $formModel
	 * @return Boolean
	 */
	public function register(StudentFormModel $formModel){
		$studentsSQL = DB::conn()->prepare('INSERT INTO students
			(name, email, phone, birthday, genre, school_id) VALUES
			(:name, :email, :phone, :birthday, :genre, :school_id)'
		);
		$studentsSQL->execute([
			':name' => $formModel->name,
			':email' => $formModel->email,
			':phone' => $formModel->phone,
			':birthday' => $formModel->birthday,
			':genre' => $formModel->genre,
			':school_id' => $formModel->school_id
		]);
		
		if($studentsSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	/*
	 * Metodo responsavel por editar um Aluno
	 * @param Integer $id
	 * @param StudentFormModel $formModel
	 * @return Void
	 */
	public function edit($id, StudentFormModel $formModel){
		$studentsSQL = DB::conn()->prepare('UPDATE students
			SET name = :name, email = :email, phone = :phone,
			birthday = :birthday, genre = :genre WHERE id = :id LIMIT 1'
		);
		$studentsSQL->execute([
			':id' => $id,
			':name' => $formModel->name,
			':email' => $formModel->email,
			':phone' => $formModel->phone,
			':birthday' => $formModel->birthday,
			':genre' => $formModel->genre
		]);
	}
	
	/*
	 * Retorna um Aluno especifico
	 * @param Integer $id
	 * @return Object
	 */
	public function find($id){
		$studentsSQL = DB::conn()->prepare('SELECT * FROM students WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $id
		]);
		
		if($studentsSQL->rowCount() > 0){
			$student = $studentsSQL->fetch(PDO::FETCH_OBJ);
			
			$schools = new Schools();
			
			$student->school = $schools->find($student->school_id);
			$student->classes = ClassStudents::getClasses($student->id);
			
			return $student;
		}
		
		return false;
	}
	
	/*
	 * Deleta um Aluno especifico
	 * @param Integer $id
	 * @return Boolean
	 */
	public function remove($id){
		$studentsSQL = DB::conn()->prepare('DELETE FROM students WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $id
		]);
	}
}
