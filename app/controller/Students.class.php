<?php
class Students {
	const GENRE = [
		0 => 'Masculino',
		1 => 'Feminino'
	];
	
	public function all($school_id = null){
		$students = [];
		
		$sql = ($school_id === null) ? 'SELECT * FROM students' : 'SELECT * FROM students WHERE school_id = :school_id';
		
		$studentsSQL = DB::conn()->prepare($sql);
		$studentsSQL->execute([
			':school_id' => $school_id
		]);
		
		while($student = $studentsSQL->fetchObject(Students::class)){
			//$schools = new Schools();
			
			//$student->school = $schools->find($classe->school_id);
			
			$students[] = $student;
		}
		
		return $students;
	}
	
	public function count($school_id = null){
		$sql = ($school_id === null) ? 'SELECT count(*) FROM students' : 'SELECT count(*) FROM students WHERE school_id = :school_id';
		
		$studentsSQL = DB::conn()->prepare($sql);
		$studentsSQL->execute([
			':school_id' => $school_id
		]);
		
		return $studentsSQL->fetchColumn();
	}
	
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
