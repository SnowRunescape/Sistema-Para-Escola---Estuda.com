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
		<?php include 'view/static/Header.php'; ?>
		
		<main id="webApp-main">
			<div id="webApp-main__container">
				<div class="title">
					👋 Muito bom ver você novamente !
				</div>
				
				<div class="description">
					Selecione a escola abaixo que deseja administrar
				</div>
				
				<div class="divisory"></div>
				
				<div id="webAppBox-schools" class="content">
					<div class="title">
						Escolas
					</div>
					
					<div class="content">
						<?php
							$listSchools = $schools->all();
							
							if($listSchools){
								foreach($listSchools as $row){ ?>
									<div class="webAppBox-school">
										<div class="image">
											<img src="/assets/img/icons/icon-school.svg">
											
											<div class="status <?= ($row->status == 1 ? 'status-active' : 'status-notActive') ?>"></div>
										</div>
										
										<div class="info">
											<a class="" href="/school/<?= $row->id; ?>"><?= htmlspecialchars($row->name); ?></a>
										</div>
										
										<div class="buttons">
											<a href="/school/<?= $row->id; ?>"><img src="/assets/img/icons/icon-manage.svg"></a>
										</div>
									</div>
								<?php }
							} else {
								echo 'Nenhuma escola cadastrado ate o momento!';
							}
						?>
					</div>
				</div>
				
				<div id="webAppBox-newSchool">
					<a href="/new"><button class="btn btn-success">Nova Escola</button></a>
				</div>
			</div>
		</main>
	</body>
</html>