<?php
class Students {
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
	
	public function edit($studentID, StudentFormModel $formModel){
		$studentsSQL = DB::conn()->prepare('UPDATE students
			SET name = :name, email = :email, phone = :phone,
			birthday = :birthday, genre = :genre WHERE id = :id LIMIT 1'
		);
		$studentsSQL->execute([
			':id' => $studentID,
			':name' => $formModel->name,
			':email' => $formModel->email,
			':phone' => $formModel->phone,
			':birthday' => $formModel->birthday,
			':genre' => $formModel->genre
		]);
	}
	
	public function remove($studentID){
		$studentsSQL = DB::conn()->prepare('DELETE FROM students WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $studentID
		]);
	}
}
