<?php 

class Login extends Conexao
{
	private $conexao;

	public function __construct()
	{	
		$this->conexao = parent::conectar();
	}

	public function validarDados($dados)
	{
		$nick_usuario = isset($dados['nick-usuario']) && trim($dados['nick-usuario']) ? trim($dados['nick-usuario']) : null;
		$senha_usuario = isset($dados['senha-usuario']) && trim($dados['senha-usuario']) ? trim($dados['senha-usuario']) : null;

		if (isset($nick_usuario) && isset($senha_usuario)) {
			return $this->validarLogin($nick_usuario, $senha_usuario);
		} else {
			return '1';
		}
	}

	private function validarLogin($nick_usuario, $senha_usuario)
	{
		$sql = "SELECT * FROM usuario WHERE nick_usuario = :nick and senha_usuario = :senha";
		$sql = $this->conexao->prepare($sql);
		$sql->bindValue(':nick', $nick_usuario);
		$sql->bindValue(':senha', md5($senha_usuario));
		$sql->execute();
		if ($sql->rowCount() == 1) {
			return $sql->fetch();
		} else {
			return '2';
		}
	}
}