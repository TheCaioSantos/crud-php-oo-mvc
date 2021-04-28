<?php 
session_start();

//Se o usuario estiver logado, não consegue ver a tela de login, e é redirecionado para 'index.php'
if (isset($_SESSION['id_usuario'])) {
	header("Location: index.php");
	exit();
}
 ?>
 <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>CRUD PHP OO MVC</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="card-body col-12 col-md-4 offset-md-4 login-form">
		<h1 class="text-center display-4">Login</h1>
		<!-- Mensagens para o usuário -->
		<?php if (isset($_GET['msg-login']) && $_GET['msg-login'] == '1'): ?>
			<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center">
				O Usuário e a senha devem ser preenchidos.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif ?>

		<?php if (isset($_GET['msg-login']) && $_GET['msg-login'] == '2'): ?>
			<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center">
				Usuário ou senha incorretos.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif ?>
		<!-- Fim das mensagens -->
		<form action="controller/login.php" method="POST">
			<div class="form-group">
				<label for="nick-usuario">Usuário</label>
				<input type="text" name="nick-usuario" class="form-control" id="nick-usuario" placeholder="Ex.: Admin">
			</div>

			<div class="form-group">
				<label for="senha-usuario">Senha</label>
				<input type="password" name="senha-usuario" class="form-control" id="senha-usuario" placeholder="Sua senha">
			</div>

			<button type="submit" class="btn btn-primary col-12 botao-login">Entrar</button>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>