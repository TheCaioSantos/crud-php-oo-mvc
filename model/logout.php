<?php 
//iniciando a sessão
session_start();

//Destroi todas as sessões 
session_destroy();

header('Location: ../login.php');
exit();
