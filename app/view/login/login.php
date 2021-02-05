<html>
	<head>
		<title>Login - Estuda.com</title>
		<meta content="charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Descrição da pagina Estuda.com">
		<meta name="keywords" content="Descrição da pagina Estuda.com">
		<meta name="author" content="https://snowdev.com.br">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="all">
		
		<link rel="stylesheet" href="/assets/css/style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" async>
		
		<script src="/assets/js/jquery.min.js"></script>
		<script src="/assets/js/webApp.js"></script>
	</head>
	
	<body id="webAppPage-login">
		<div id="webApp-main">
			<div id="webApp-login" class="webAppMain__container">
				<form id="webAppForm-login" onsubmit="webApp.user.login();return false;" autocomplete="off">
					<div class="field logo">
						<img src="/assets/img/logo.png">
					</div>
					
					<div class="webAppForm__error"></div>
					
					<div class="field">
						<label>E-mail</label>
						
						<input type="text" name="email" placeholder="E-mail">
					</div>
					
					<div class="field">
						<label>Senha</label>
						
						<input type="password" name="password" placeholder="Senha">
					</div>
					
					<div class="field">
						<input type="submit" class="btn btn-success" value="Entrar">
					</div>
					
					<div class="divisory"></div>
					
					<div class="field">
						<p>Ainda não tem uma conta?</p>
						<p><a href="/register" class="link">Cadastre-se</a></p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>