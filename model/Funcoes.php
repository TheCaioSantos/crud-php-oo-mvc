<?php 
class Funcoes extends Conexao
{
	private $conexao;
	
	public function __construct()
	{
		$this->conexao = parent::conectar();
	}

	public function paginacao($tabela, $pagina, $quantidade_por_pagina){
		$sql = "SELECT * FROM $tabela";
		$sql = $this->conexao->query($sql);

		$numero_total = $sql->rowCount();
		$numero_paginas = ceil($numero_total / $quantidade_por_pagina);

		for ($i = 1; $i <= $numero_paginas ; $i++) { 
			echo '<li class="page-item"><a class="page-link" href="?pagina=' . $pagina . '&page=' . $i . '">' . $i . '</a></li>';
		}
	}
}