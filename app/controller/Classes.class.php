<?php
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
	
	public function all(){
		$classes = [];
		
		$studentsSQL = DB::conn()->prepare('SELECT * FROM classes');
		$studentsSQL->execute();
		
		while($classe = $studentsSQL->fetchObject(Classes::class)){
			$schools = new Schools();
			
			$classe->school = $schools->find($classe->school_id);
			
			$classes[] = $classe;
		}
		
		if(count($classes) == 0){
			return false;
		}
		
		return $classes;
	}
	
	public function register(ClasseFormModel $formModel){
		$classesSQL = DB::conn()->prepare('INSERT INTO classes
			(school_id, education_level, series, period) VALUES
			(:school_id, :education_level, :series, :period)'
		);
		$classesSQL->execute([
			':school_id' => $formModel->school_id,
			':education_level' => $formModel->education_level,
			':series' => $formModel->series,
			':period' => $formModel->period
		]);
		
		if($classesSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	public function edit($id, ClasseFormModel $formModel){
		$classesSQL = DB::conn()->prepare('UPDATE classes
			SET school_id = :school_id, education_level = :education_level,
			series = :series, period = :period WHERE id = :id LIMIT 1'
		);
		$classesSQL->execute([
			':id' => $id,
			':school_id' => $formModel->school_id,
			':education_level' => $formModel->education_level,
			':series' => $formModel->series,
			':period' => $formModel->period
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
