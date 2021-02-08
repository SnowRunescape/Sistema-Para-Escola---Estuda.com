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
		<?php include 'view/panel/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/panel/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Editando Turma
				</div>
				
				<div class="divisory"></div>
				
				<div class="content">
					<form id="webAppForm-classe" onsubmit="webApp.classes.editClasse();return false;" autocomplete="off">
						<div class="webAppForm__error"></div>
						
						<div class="field">
							<label>Turma</label>
							
							<input value="<?= $classe->id ?>" disabled>
							<input type="hidden" name="classe_id" value="<?= $classe->id ?>">
						</div>
						
						<div class="field">
							<label>Selecione a Escola</label>
							
							<select name="school_id">
								<option selected disabled hidden>Selecione uma Escola</option>
								
								<?php
									$schools = new Schools();
									
									$schoolsList = $schools->all();
									
									foreach($schoolsList as $school){
										echo '<option value="' . $school->id . '" ' . (($school->id == $classe->school->id) ? "selected" : '') . '>'.$school->name.'</option>';
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
										if($classe->education_level == $education_level_key){
											echo '<option value="' . $education_level_key . '" selected>' . $education_level_value . '</option>';
										} else {
											echo '<option value="' . $education_level_key . '">' . $education_level_value . '</option>';
										}
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
											if($classe->education_level == $education_level){
												if($classe->series == $series_key){
													echo '<option value="' . $series_key . '" education_level="' . $education_level . '" selected>' . $series_value . '</option>';
												} else {
													echo '<option value="' . $series_key . '" education_level="' . $education_level . '">' . $series_value . '</option>';
												}
											} else {
												echo '<option value="' . $series_key . '" education_level="' . $education_level . '" hidden>' . $series_value . '</option>';
											}
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
										if($classe->period == $period_key){
											echo '<option value="' . $period_key . '" selected>' . $period_value .'</option>';
										} else {
											echo '<option value="' . $period_key . '">' . $period_value .'</option>';
										}
									}
								?>
							</select>
						</div>
						
						<div class="field">
							<label>Ano</label>
							
							<input type="number" name="year" value="<?= $classe->year; ?>">
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