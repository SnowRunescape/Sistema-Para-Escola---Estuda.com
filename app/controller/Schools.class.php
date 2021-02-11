<?php
class Schools {
	/*
	 * Variaveis constantes responsaveis por definir o conteudo
	 * e filtrar os dados que estão sendo enviado dos formularios
	 */
	const STATUS = [
		0 => 'Desativada',
		1 => 'Ativada'
	];
	
	/*
	 * Retorna todas as Escolas
	 * @return Array
	 */
	public function all(){
		$school = [];
		
		$studentsSQL = DB::conn()->prepare('SELECT * FROM schools');
		$studentsSQL->execute();
		
		while($row = $studentsSQL->fetchObject(Schools::class)){
			$school[] = $row;
		}
		
		if(count($school) == 0){
			return false;
		}
		
		return $school;
	}
	
	/*
	 * Metodo responsavel por registrar uma nova Escola
	 * @param SchoolFormModel $formModel
	 * @return Boolean
	 */
	public function register(SchoolFormModel $formModel){
		$studentsSQL = DB::conn()->prepare('INSERT INTO schools
			(name, andress, date, status) VALUES
			(:name, :andress, :date, :status)'
		);
		$studentsSQL->execute([
			':name' => $formModel->name,
			':andress' => $formModel->andress,
			':date' => '0000-00-00',
			':status' => $formModel->status
		]);
		
		if($studentsSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
	
	/*
	 * Metodo responsavel por editar uma Escola
	 * @param Integer $id
	 * @param SchoolFormModel $formModel
	 * @return Void
	 */
	public function edit($id, SchoolFormModel $formModel){
		$schoolsSQL = DB::conn()->prepare('UPDATE schools
			SET name = :name, andress = :andress, status = :status
			WHERE id = :id LIMIT 1'
		);
		$schoolsSQL->execute([
			':id' => $id,
			':name' => $formModel->name,
			':andress' => $formModel->andress,
			':status' => $formModel->status
		]);
	}
	
	/*
	 * Retorna uma Escola especifica
	 * @param Integer $id
	 * @return Object
	 */
	public function find($id){
		$studentsSQL = DB::conn()->prepare('SELECT * FROM schools WHERE id = :id LIMIT 1');
		$studentsSQL->execute([
			':id' => $id
		]);
		
		if($studentsSQL->rowCount() > 0){
			return $studentsSQL->fetchObject(Schools::class);
		}
		
		return false;
	}
	
	/*
	 * Deleta uma Escola especifica
	 * @param Integer $id
	 * @return Boolean
	 */
	public function remove($id){
		$schoolsSQL = DB::conn()->prepare('DELETE FROM schools WHERE id = :id LIMIT 1');
		$schoolsSQL->execute([
			':id' => $id
		]);
		
		if($schoolsSQL->rowCount() > 0){
			return true;
		}
		
		return false;
	}
}
