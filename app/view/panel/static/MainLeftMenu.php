<div id="webApp-main__menu">
	<div class="header">
		<div class="avatar">
			<img src="/assets/img/gravatar.png">
		</div>
		
		<div class="info">
			<p class="username">Username<p>
			<p class="role">Role<p>
		</div>
	</div>
	
	<div class="buttons">
		<ul>
			<a href="/panel/"><li <?php if($panelPage == 'dashboard'){ echo 'class="selected"'; } ?>>Dashboard</li></a>
			<a href="/panel/schools"><li <?php if($panelPage == 'schools'){ echo 'class="selected"'; } ?>>Escolas</li></a>
			<a href="/panel/classes"><li <?php if($panelPage == 'classes'){ echo 'class="selected"'; } ?>>Turmas</li></a>
			<a href="/panel/students"><li <?php if($panelPage == 'students'){ echo 'class="selected"'; } ?>>Alunos</li></a>
		</ul>
	</div>
</div>