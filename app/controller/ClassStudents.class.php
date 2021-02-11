<?php
class ClassStudents {
	/*
	 * Retorna todas as turmas que um aluno está vinculado
	 * @param Integer $id
	 * @return Array
	 */
	public static function getClasses($id){
		$classes = new Classes();
		
		$listClasses = [];
		
		$classStudentsSQL = DB::conn()->prepare('SELECT class FROM classes_students WHERE student = :student');
		$classStudentsSQL->execute([
			':student' => $id
		]);
		
		while($classStudents = $classStudentsSQL->fetch(PDO::FETCH_OBJ)){
			$listClasses[] = $classStudents->class;
		}
		
		return $listClasses;
	}
	
	/*
	 * Retorna todos os alunos vinculado a uma turma
	 * @param Integer $id
	 * @return Array
	 */
	public static function getStudents($id){
		$students = new Students();
		
		$listStudents = [];
		
		$classStudentsSQL = DB::conn()->prepare('SELECT student FROM classes_students WHERE class = :class');
		$classStudentsSQL->execute([
			':class' => $id
		]);
		
		while($classStudents = $classStudentsSQL->fetch(PDO::FETCH_OBJ)){
			$listStudents[] = $students->find($classStudents->student);
		}
		
		return $listStudents;
	}
}
