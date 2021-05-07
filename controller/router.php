<?php 
if (isset($_GET['pagina']) && $pagina = trim($_GET['pagina'])) {
	$filename = "view/" . $pagina . ".php";
	//Verificando se a pagina chamada existe
	if (file_exists($filename)) {
		//verificação se o usuário está logado
		if (isset($_SESSION['id_usuario'])) {
			require_once $filename;
		} else {
			//Se não estiver logado, o usuário é redirecionado para pagina 'index.php'
			header("Location: login.php");
			exit();
		}
	} else {
		//Se o arquivo não existir, o usuário é redirecionado para pagina '404.php'
		require_once "view/erro/404.php";
	}
} else {
	//Se nenhuma pagina for passada, o usuário é redirecionado para pagina 'listar.php'
	require_once "view/funcionario/listar.php";
}
