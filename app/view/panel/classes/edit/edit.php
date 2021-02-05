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
	</head>
	
	<body>
		<?php include 'view/panel/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/panel/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Editando Escola
				</div>
				
				<div class="divisory"></div>
				
				<div class="content">
					<form id="webAppForm-school" onsubmit="webApp.school.editSchool();return false;" autocomplete="off">
						<div class="webAppForm__error"></div>
						
						<div class="field">
							<label>ID da Escola</label>
							<input type="text" name="id" placeholder="Nome da Escola" value="<?= $school->id; ?>">
						</div>
						
						<div class="field">
							<label>Nome da Escola</label>
							<input type="text" name="name" placeholder="Nome da Escola" value="<?= htmlspecialchars($school->name); ?>">
						</div>
						
						<div class="field">
							<label>Endereço da Escola</label>
							<input type="text" name="andress" placeholder="Endereço da Escola" value="<?= $school->andress; ?>">
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