<html>
	<head>
		<title>Pagina Inicial - Estuda.com</title>
		<meta content="charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Descrição da pagina Estuda.com">
		<meta name="keywords" content="Descrição da pagina Estuda.com">
		<meta name="author" content="https://snowdev.com.br">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="all">
		
		<link rel="stylesheet" href="/assets/css/panel.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" async>
		
		<script src="/assets/js/jquery.min.js"></script>
		<script src="/assets/js/webApp.js"></script>
		
		<script>
			function educationLevelChange(e){
				$('#webAppForm-classe select[name="series"] option').attr('hidden', true);
				$('#webAppForm-classe select[name="series"] option[disabled]').prop('selected', true);
				$('#webAppForm-classe select[name="series"] option[education_level="' + e.value + '"]').removeAttr('hidden');
			}
		</script>
	</head>
	
	<body>
		<?php include 'view/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Editando Aluno
				</div>
				
				<div class="divisory"></div>
				
				<div class="content">
					<form id="webAppForm-student" onsubmit="webApp.students.editStudent();return false;" autocomplete="off">
						<div class="webAppForm__error"></div>
						
						<div class="field">
							<label>ID do Aluno</label>
							
							<input type="text" value="<?= $student->id; ?>" disabled>
							<input type="hidden" name="student_id" value="<?= $student->id; ?>">
							<input type="hidden" name="school_id" value="<?= $student->school_id; ?>">
						</div>
						
						<div class="field">
							<label>Nome</label>
							
							<input type="text" name="name" placeholder="Nome" value="<?= $student->name; ?>">
						</div>
						
						<div class="field">
							<label>Email</label>
							
							<input type="text" name="email" placeholder="Email" value="<?= $student->email; ?>">
						</div>
						
						<div class="field">
							<label>Numero de Telefone</label>
							
							<input type="text" name="phone" placeholder="Numero de Telefone" value="<?= $student->phone; ?>">
						</div>
						
						<div class="field">
							<label>Data de Nascimento</label>
							
							<input type="date" name="birthday" placeholder="Data de Nascimento" value="<?= $student->birthday; ?>">
						</div>
						
						<div class="field">
							<label>Gênero</label>
							
							<select name="genre">
								<option selected disabled hidden>Selecione o Gênero</option>
								
								<?php
									foreach(Students::GENRE as $genre_key => $genre_value){
										if($student->genre == $genre_key){
											echo '<option value="' . $genre_key . '" selected>' . $genre_value .'</option>';
										} else {
											echo '<option value="' . $genre_key . '">' . $genre_value .'</option>';
										}
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<button class="btn btn-success">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</main>
	</body>
</html>