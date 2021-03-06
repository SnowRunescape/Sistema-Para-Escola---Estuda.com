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
		<script src="/assets/js/sweetalert.min.js"></script>
	</head>
	
	<body>
		<?php include 'view/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Turmas
				</div>
				
				<div class="divisory"></div>
				
				<div class="buttons">
					<a href="/school/<?= $schoolID; ?>/classes/new" class="btn btn-success">+ Nova Turma</a>
				</div>
				
				<div class="content">
					<div id="search">
						<form id="webAppForm-search">
							<div class="field field-group">
								<input type="text" placeholder="Pesquisar...">
								<input type="submit" class="btn btn-primary" value="Buscar">
							</div>
						</form>
					</div>
					
					<div id="classes">
						<?php
							$listClasses = $classes->all($schoolID);
							
							if($listClasses){
								foreach($listClasses as $row){ ?>
									<div class="classe">
										<div class="image">
											<img src="/assets/img/icons/icon-classes.svg">
										</div>
										
										<div class="info">
											<p><b>Turma:</b> <?= $row->id; ?></p>
											<p><b>Alunos:</b> <?= count($row->students); ?></p>
										</div>
										
										<div class="buttons">
											<a href="/school/<?= $schoolID; ?>/classes/edit/<?= $row->id; ?>"><img src="/assets/img/icons/icon-edit.svg"></a>
											<a onclick="webApp.classes.prepareRemoveClasse(<?= $row->id; ?>)"><img src="/assets/img/icons/icon-delete.svg"></a>
										</div>
									</div>
								<?php }
							} else { ?>
								<div class="webAppBox__error">
									<div class="title">
										Nenhuma Turma Localizada
									</div>
									
									<div class="content">
										Nenhuma turma criada ate o momento!
									</div>
								</div>
							<?php }
						?>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>