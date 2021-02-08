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
				$('#webAppForm-classe select[name="series"] option[education_level="' + e.value + '"]').removeAttr('hidden');
			}
		</script>
	</head>
	
	<body>
		<?php include 'view/panel/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/panel/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Nova Turma
				</div>
				
				<div class="divisory"></div>
				
				<div class="content">
					<form id="webAppForm-classe" onsubmit="webApp.classes.newClasse();return false;" autocomplete="off">
						<div class="webAppForm__error"></div>
						
						<div class="field">
							<label>Selecione a Escola</label>
							
							<select name="school_id">
								<option selected disabled hidden>Selecione uma Escola</option>
								
								<?php
									$schools = new Schools();
									
									$schoolsList = $schools->all();
									
									foreach($schoolsList as $school){
										echo '<option value="'.$school->id.'">'.$school->name.'</option>';
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<label>Selecione o Nivel de Ensino</label>
							
							<select name="education_level" onchange="educationLevelChange(this);">
								<option selected disabled hidden>Selecione o Nivel de Ensino</option>
								
								<?php
									foreach(Classes::EDUCATION_LEVEL as $education_level_key => $education_level_value){
										echo '<option value="' . $education_level_key . '">' . $education_level_value . '</option>';
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<label>Serie</label>
							
							<select name="series">
								<option selected disabled>Selecione a Serie</option>
								
								<?php
									foreach(Classes::SERIES as $education_level => $series){
										foreach($series as $series_key => $series_value){
											echo '<option value="' . $series_key . '" education_level="' . $education_level . '" hidden>' . $series_value . '</option>';
										}
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<label>Periodo</label>
							
							<select name="period">
								<option selected disabled hidden>Selecione o Periodo</option>
								
								<?php
									foreach(Classes::PERIOD as $period_key => $period_value){
										echo '<option value="' . $period_key . '">' . $period_value .'</option>';
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<label>Ano</label>
							
							<input type="number" name="year" value="<?= date('Y'); ?>">
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