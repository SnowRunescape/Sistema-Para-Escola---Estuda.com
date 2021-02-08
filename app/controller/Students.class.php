<?php
class Students {
	const GENRE = [
		0 => 'Masculino',
		1 => 'Feminino'
	];
	
	public function all(){
		$students = [];
		
		$studentsSQL = DB::conn()->prepare('SELECT * FROM students');
		$studentsSQL->execute();
		
		while($student = $studentsSQL->fetchObject(Students::class)){
			//$schools = new Schools();
			
			//$student->school = $schools->find($classe->school_id);
			
			$students[] = $student;
		}
		
		if(count($students) == 0){
			return false;
		}
		
		return $students;
	}
	
	public function register(StudentFormModel $formModel){
		$studentsSQL = DB::conn()->prepare('INSERT INTO students
			(name, email, phone, birthday, genre) VALUES
			(:name, :email, :phone, :birthday, :genre)'
		);
		$studentsSQL->execute([
			':name' => $formModel->name,
			':email' => $formModel->email,
			':phone' => $formModel->phone,
			':birthday' => $formModel->birthday,
			':genre' => $formModel->genre
		]);
		
		if($studentsSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
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
	
	public function find($id){
		$studentsSQL = DB::conn()->prepare('SELECT * FROM students WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $id
		]);
		
		if($studentsSQL->rowCount() > 0){
			$student = $studentsSQL->fetchObject(Students);
			
			//$schools = new Schools();
			
			//$student->school = $schools->find($classe->school_id);
			
			return $student;
		}
		
		return false;
	}
	
	public function remove($id){
		$studentsSQL = DB::conn()->prepare('DELETE FROM students WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $id
		]);
	}
}
