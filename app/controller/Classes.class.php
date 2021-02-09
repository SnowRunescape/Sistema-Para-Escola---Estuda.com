<?php
require_once 'controller/ClassStudents.class.php';
require_once 'controller/Schools.class.php';

class Classes {
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
	
	public function all($school_id = null){
		$classes = [];
		
		$sql = ($school_id === null) ? 'SELECT * FROM classes' : 'SELECT * FROM classes WHERE school_id = :school_id';
		
		$classesSQL = DB::conn()->prepare($sql);
		$classesSQL->execute([
			':school_id' => $school_id
		]);
		
		while($classe = $classesSQL->fetchObject(Classes::class)){
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
	
	public function count($school_id = null){
		$sql = ($school_id === null) ? 'SELECT count(*) FROM classes' : 'SELECT count(*) FROM classes WHERE school_id = :school_id';
		
		$classesSQL = DB::conn()->prepare($sql);
		$classesSQL->execute([
			':school_id' => $school_id
		]);
		
		return $classesSQL->fetchColumn();
	}
	
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
	
	public function find($id){
		$classesSQL = DB::conn()->prepare('SELECT * FROM classes WHERE id = :id LIMIT 1');
		$classesSQL->execute([
			':id' => $id
		]);
		
		if($classesSQL->rowCount() > 0){
			$classe = $classesSQL->fetchObject(Classes);
			
			$schools = new Schools();
			
			$classe->school = $schools->find($classe->school_id);
			
			return $classe;
		}
		
		return false;
	}
	
	public function remove($id){
		$schoolsSQL = DB::conn()->prepare('DELETE FROM classes WHERE id = :id LIMIT 1');
		$schoolsSQL->execute([
			':id' => $id
		]);
		
		if($schoolsSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
}
