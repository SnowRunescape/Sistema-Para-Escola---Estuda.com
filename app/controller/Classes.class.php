<?php
require_once 'controller/ClassStudents.class.php';
require_once 'controller/Schools.class.php';

class Classes {
	/*
	 * Variaveis constantes responsaveis por definir o conteudo
	 * e filtrar os dados que estão sendo enviado dos formularios
	 */
	const EDUCATION_LEVEL = [
		0 => 'Ensino Fundamental',
		1 => 'Ensino Medio'
	];
	
	const SERIES = [
		0 => [
			0 => '1° Serie',
			1 => '2° Serie',
			2 => '3° Serie',
			3 => '4° Serie',
			4 => '5° Serie',
			5 => '6° Serie',
			6 => '7° Serie',
			7 => '8° Serie',
			8 => '9° Serie'
		],
		1 => [
			0 => '1° Ano',
			1 => '2° Ano',
			2 => '3° Ano'
		]
	];
	
	const PERIOD = [
		0 => 'Matutino',
		1 => 'Vespertino',
		2 => 'Noturno'
	];
	
	/*
	 * Retorna todas as Turmas de uma Escola especifica
	 * @param Integer $school_id
	 * @return Array
	 */
	public function all($school_id = null){
		$classes = [];
		
		$sql = ($school_id === null) ? 'SELECT * FROM classes' : 'SELECT * FROM classes WHERE school_id = :school_id';
		
		$classesSQL = DB::conn()->prepare($sql);
		$classesSQL->execute([
			':school_id' => $school_id
		]);
		
		while($classe = $classesSQL->fetch(PDO::FETCH_OBJ)){
			$schools = new Schools();
			
			$classe->school = $schools->find($classe->school_id);
			$classe->students = ClassStudents::getStudents($classe->id);
			
			$classes[] = $classe;
		}
		
		if(count($classes) == 0){
			return false;
		}
		
		return $classes;
	}
	
	/*
	 * Retorna o numero de Turmas de uma Escola especifica
	 * @param Integer $school_id
	 * @return Integer
	 */
	public function count($school_id = null){
		$sql = ($school_id === null) ? 'SELECT count(*) FROM classes' : 'SELECT count(*) FROM classes WHERE school_id = :school_id';
		
		$classesSQL = DB::conn()->prepare($sql);
		$classesSQL->execute([
			':school_id' => $school_id
		]);
		
		return $classesSQL->fetchColumn();
	}
	
	/*
	 * Metodo responsavel por registrar uma nova Turma
	 * @param ClasseFormModel $formModel
	 * @return Boolean
	 */
	public function register(ClasseFormModel $formModel){
		$classesSQL = DB::conn()->prepare('INSERT INTO classes
			(school_id, education_level, series, period, year) VALUES
			(:school_id, :education_level, :series, :period, :year)'
		);
		$classesSQL->execute([
			':school_id' => $formModel->school_id,
			':education_level' => $formModel->education_level,
			':series' => $formModel->series,
			':period' => $formModel->period,
			':year' => $formModel->year
		]);
		
		if($classesSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	/*
	 * Metodo responsavel por editar uma Turma
	 * @param Integer $id
	 * @param ClasseFormModel $formModel
	 * @return Void
	 */
	public function edit($id, ClasseFormModel $formModel){
		$classesSQL = DB::conn()->prepare('UPDATE classes
			SET school_id = :school_id, education_level = :education_level,
			series = :series, period = :period, year = :year WHERE id = :id LIMIT 1'
		);
		$classesSQL->execute([
			':id' => $id,
			':school_id' => $formModel->school_id,
			':education_level' => $formModel->education_level,
			':series' => $formModel->series,
			':period' => $formModel->period,
			':year' => $formModel->year
		]);
	}
	
	/*
	 * Retorna uma Turma especifica
	 * @param Integer $id
	 * @return Object
	 */
	public function find($id){
		$classesSQL = DB::conn()->prepare('SELECT * FROM classes WHERE id = :id LIMIT 1');
		$classesSQL->execute([
			':id' => $id
		]);
		
		if($classesSQL->rowCount() > 0){
			$classe = $classesSQL->fetch(PDO::FETCH_OBJ);
			
			$schools = new Schools();
			
			$classe->school = $schools->find($classe->school_id);
			$classe->students = ClassStudents::getStudents($classe->id);
			
			return $classe;
		}
		
		return false;
	}
	
	/*
	 * Deleta uma Turma especifica
	 * @param Integer $id
	 * @return Boolean
	 */
	public function remove($id){
		$classesSQL = DB::conn()->prepare('DELETE FROM classes WHERE id = :id LIMIT 1');
		$classesSQL->execute([
			':id' => $id
		]);
		
		if($classesSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	/*
	 * Adiciona uma aluno de uma turma especifica
	 * @param Integer $class_id
	 * @param Integer $student_id
	 * @return Boolean
	 */
	public function addStudent($class_id, $student_id){
		/* 
		 * FALTA IMPLEMENTAR UMA FUNÇÃO PARA VERIFICAR SE O ALUNO
		 * JÁ ESTA CADASTRADO NA TURMA EM QUESTÃO
		 */
		$classesSQL = DB::conn()->prepare('INSERT INTO classes_students	
			(student, class) VALUES (:student, :class)'
		);
		$classesSQL->execute([
			':student' => $student_id,
			':class' => $class_id
		]);
		
		if($classesSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	/*
	 * Deleta uma aluno de uma turma especifica
	 * @param Integer $class_id
	 * @param Integer $student_id
	 * @return Boolean
	 */
	public function removeStudent($class_id, $student_id){
		$classesSQL = DB::conn()->prepare('DELETE FROM classes_students WHERE
			student = :student AND class = :class LIMIT 1'
		);
		$classesSQL->execute([
			':student' => $student_id,
			':class' => $class_id
		]);
		
		if($classesSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
}
