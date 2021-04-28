<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//Chamando arquivo que tem a função de validar dados de login
	require_once "../model/Conexao.php";
	require_once "../model/Login.php";
	$login = new Login();
	$situacao = $login->validarDados($_POST);

	if (is_array($situacao)) {
		$_SESSION['id_usuario'] = $situacao['id_usuario'];
		header("Location: ../index.php");		
	} else {
		header("Location: ../login.php?msg-login=" . $situacao);
	}
	exit();
} else {
	header("Location: ../login.php");
	exit();
}