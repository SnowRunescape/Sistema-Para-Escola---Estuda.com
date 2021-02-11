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
		
		<script>
			this.school = {
				id: <?= $schoolID; ?>,
				class: {
					id: <?= $classe->id; ?>
				}
			}
		</script>
		
		<style>
			.select2-container {
				z-index:9999;
			}
		</style>
		
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
					Lista de alunos - Turma #<?= $classe->id ?>
				</div>
				
				<div class="divisory"></div>
				
				<div class="buttons">
					<button class="btn btn-success" onclick="webApp.classes.prepareAddStudent();">+ Adicionar Aluno</button>
				</div>
				
				<div class="content">					
					<div id="students">
						<?php
							$listStudents = $classes->find($classe->id);
							
							if($listStudents && $listStudents->students){
								foreach($listStudents->students as $row){ ?>
									<div class="student">
										<div class="image">
											<img src="/assets/img/icons/icon-classes.svg">
										</div>
										
										<div class="info">
											<p><b>Aluno:</b> <?= $row->name; ?></p>
										</div>
										
										<div class="buttons">
											<a onclick="webApp.classes.prepareRemoveStudent(<?= $row->id; ?>);"><img src="/assets/img/icons/icon-delete.svg"></a>
										</div>
									</div>
								<?php }
							} else { ?>
								<div class="webAppBox__error">
									<div class="title">
										Nenhuma Aluno Localizada
									</div>
									
									<div class="content">
										Nenhuma aluno cadastrado ate o momento!
									</div>
								</div>
							<?php }
						?>
					</div>
				</div>
			</div>
		</main>
	</body>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>