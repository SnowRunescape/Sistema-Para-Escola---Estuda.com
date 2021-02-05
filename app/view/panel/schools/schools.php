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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	</head>
	
	<body>
		<?php include 'view/panel/static/Header.php'; ?>
		
		<main id="webApp-main">
			<?php include 'view/panel/static/MainLeftMenu.php'; ?>
			
			<div id="webApp-main__container">
				<div class="title">
					Escolas
				</div>
				
				<div class="divisory"></div>
				
				<div class="buttons">
					<a href="/panel/schools/new" class="btn btn-success">+ Nova Escola</a>
				</div>
				
				<div class="content">
					<div id="schools">
						<?php
							$listSchools = $schools->all();
							
							if($listSchools){
								foreach($listSchools as $row){ ?>
									<div class="school">
										<div class="image">
											<img src="/assets/img/icons/icon-school.svg">
										</div>
										
										<div class="title">
											<?= htmlspecialchars($row->name); ?>
										</div>
										
										<div class="buttons">
											<a href="/panel/schools/edit/<?= $row->id; ?>"><img src="/assets/img/icons/icon-edit.svg"></a>
											<a onclick="webApp.school.prepareRemoveSchool(<?= $row->id; ?>)"><img src="/assets/img/icons/icon-delete.svg"></a>
										</div>
									</div>
								<?php }
							} else {
								echo 'nenhuma escola publicada ate o momento';
							}
						?>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>