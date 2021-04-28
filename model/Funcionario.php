<?php 

class Funcionario extends Conexao
{
	private $conexao;

	public function __construct()
	{
		$this->conexao = parent::conectar();
	}

	public function validarFuncionario($dados, $id_funcionario) 
	{
		$erros = array();

		//Verificando se está preenchido
		$nome_funcionario = isset($dados['nome-funcionario']) && trim($dados['nome-funcionario']) ? trim($dados['nome-funcionario']) : null;
		$id_cargo = isset($dados['id-cargo']) && trim($dados['id-cargo']) ? trim($dados['id-cargo']) : null;
		$modo_de_trabalho = isset($dados['modo-de-trabalho']) && trim($dados['modo-de-trabalho']) ? trim($dados['modo-de-trabalho']) : null;
		$data_inicio = isset($dados['data-inicio']) && trim($dados['data-inicio']) ? trim($dados['data-inicio']) : null;

		if (!$nome_funcionario) {
			$erros[] = 'nome-funcionario';
		}

		if (!$id_cargo) {
			$erros[] = 'id-cargo';
		}

		if (!$modo_de_trabalho) {
			$erros[] = 'modo-de-trabalho';
		}

		if (!$data_inicio) {
			$erros[] = 'data-inicio';
		}

		//Retornando array 'erros' e 'dados'
		return array(
			'erros' => $erros,
			'dados' => array(
				'nome-funcionario' => $nome_funcionario,
				'id-cargo' => $id_cargo,
				'modo-de-trabalho' => $modo_de_trabalho,
				'data-inicio' => $data_inicio,
			)
		);
	}

	public function inserirFuncionario($dados) 
	{
		session_start();

		$id_usuario = $_SESSION['id_usuario'];

		$sql = "INSERT INTO funcionario VALUES (default, :nome_funcionario, :modo_trabalho, :data_inicio, '$id_usuario', :id_cargo)";
		$sql = $this->conexao->prepare($sql);
		$sql->bindValue(':nome_funcionario', $dados['nome-funcionario']);
		$sql->bindValue(':modo_trabalho', $dados['modo-de-trabalho']);
		$sql->bindValue(':data_inicio', $dados['data-inicio']);
		$sql->bindValue(':id_cargo', $dados['id-cargo']);
		
		return $sql->execute();
	}

	function atualizarfuncionario($dados, $id_funcionario) 
	{
		$sql = "UPDATE funcionario SET 
		nome_funcionario = :nome_funcionario, 
		modo_de_trabalho_funcionario = :modo_trabalho,
		data_inicio_funcionario = :data_inicio,
		id_cargo = :id_cargo 
		WHERE id_funcionario = :id_funcionario";

		$sql = $this->conexao->prepare($sql);
		$sql->bindValue(':nome_funcionario', $dados['nome-funcionario']);
		$sql->bindValue(':modo_trabalho', $dados['modo-de-trabalho']);
		$sql->bindValue(':data_inicio', $dados['data-inicio']);
		$sql->bindValue(':id_cargo', $dados['id-cargo']);
		$sql->bindValue(':id_funcionario', $id_funcionario);

		return $sql->execute();
	}

	public function consultarFuncionario($id_funcionario = null, $inicio = null, $quantidade_por_pagina = null)
	{
		$sql = "SELECT * FROM funcionario f 
		INNER JOIN usuario u ON f.id_usuario = u.id_usuario
		INNER JOIN cargo c ON f.id_cargo = c.id_cargo";

		if (isset($id_funcionario)) {
			$sql .= " WHERE f.id_funcionario = :id_funcionario";
			$sql = $this->conexao->prepare($sql);
			$sql->bindValue(':id_funcionario', $id_funcionario);
		} else {
			if (isset($inicio)) {
				$sql .= " ORDER BY f.id_funcionario DESC LIMIT $inicio, $quantidade_por_pagina";
				$sql = $this->conexao->prepare($sql);
			} else {
				$sql .= " ORDER BY f.id_funcionario DESC LIMIT $quantidade_por_pagina";
				$sql = $this->conexao->prepare($sql);
			}
		}

		$sql->execute();
		if ($sql->rowCount() > 0) {
			if (isset($id_funcionario)) {
				return $sql->fetch();
			} else {
				return $sql->fetchAll();
			}
		} else {
			return array();
		}	
	}

	public function removerFuncionario($id_funcionario)
	{
		$sql = "DELETE FROM funcionario WHERE id_funcionario = :id_funcionario";
		$sql = $this->conexao->prepare($sql);
		$sql->bindValue('id_funcionario', $id_funcionario);
		$sql->execute();
	}

	public function consultarCargos()
	{
		$sql = "SELECT * FROM cargo";
		$sql = $this->conexao->query($sql);

		if ($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			return array();
		}
	}
}