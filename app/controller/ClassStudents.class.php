<?php
class ClassStudents {
	public static function getStudents($id){
		$students = [];
		
		$classStudentsSQL = DB::conn()->prepare('SELECT * FROM classes_students WHERE class = :class');
		$classStudentsSQL->execute([
			':class' => $id
		]);
		
		while($classStudents = $classStudentsSQL->fetchObject()){
			$students[] = $classStudents->student;
		}
		
		return $students;
	}
}
