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
		<?php include 'view/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Novo Aluno
				</div>
				
				<div class="divisory"></div>
				
				<div class="content">
					<form id="webAppForm-student" onsubmit="webApp.students.newStudent();return false;" autocomplete="off">
						<div class="webAppForm__error"></div>
						
						<div class="field hide">
							<label>ID da Escola</label>
							
							<input type="text" name="school_id" value="<?= $schoolID; ?>">
						</div>
						
						<div class="field">
							<label>Nome</label>
							
							<input type="text" name="name" placeholder="Nome">
						</div>
						
						<div class="field">
							<label>Email</label>
							
							<input type="text" name="email" placeholder="Email">
						</div>
						
						<div class="field">
							<label>Numero de Telefone</label>
							
							<input type="text" name="phone" placeholder="Numero de Telefone">
						</div>
						
						<div class="field">
							<label>Data de Nascimento</label>
							
							<input type="date" name="birthday" placeholder="Data de Nascimento">
						</div>
						
						<div class="field">
							<label>Gênero</label>
							
							<select name="genre">
								<option selected disabled hidden>Selecione o Gênero</option>
								<option value="0">Masculino</option>
								<option value="1">Feminino</option>
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