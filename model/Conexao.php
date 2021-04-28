<?php 

class Conexao
{
	public function conectar()
	{
		try {
			return new PDO('mysql:host=localhost;dbname=crudphp;charset=utf8', 'root', '');
		} catch (PDO_Exception $e) {
			echo "Falhou: " . $e->getMessage();
		}
	}
}