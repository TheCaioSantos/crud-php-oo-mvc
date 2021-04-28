<?php 
session_start();

if (empty($_SESSION['id_usuario'])) {
	header("Location: login.php");
	exit();
}

require_once "view/head.php";
require_once "controller/router.php";
require_once "view/footer.php";