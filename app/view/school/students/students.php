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
					Alunos
				</div>
				
				<div class="divisory"></div>
				
				<div class="buttons">
					<a href="/school/<?= $schoolID; ?>/students/new" class="btn btn-success">+ Novo Aluno</a>
				</div>
				
				<div class="content">
					<div id="students">
						<?php
							$listStudents = $students->all($schoolID);
							
							if($listStudents){
								foreach($listStudents as $row){ ?>
									<div class="student">
										<div class="image">
											<img src="/assets/img/icons/icon-classes.svg">
										</div>
										
										<div class="info">
											<p><b>Aluno:</b> <?= $row->name; ?></p>
										</div>
										
										<div class="buttons">
											<a href="/school/<?= $schoolID; ?>/students/edit/<?= $row->id; ?>"><img src="/assets/img/icons/icon-edit.svg"></a>
											<a onclick="webApp.students.prepareRemoveStudent(<?= $row->id; ?>)"><img src="/assets/img/icons/icon-delete.svg"></a>
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
</html>