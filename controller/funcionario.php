<?php 
require_once "../model/Conexao.php";
require_once "../model/Funcionario.php";
$funcionario = new Funcionario();

if (isset($_GET['remover']) && $_GET['remover'] == true) {
	$funcionario->removerFuncionario($_GET['id-funcionario']);
	header("Location: ../index.php?pagina=funcionario/listar&msg-remover=1");
	exit();
}

//Variável usada na parte de edição do funcionario
$id_funcionario = isset($_GET['id-funcionario']) ? trim($_GET['id-funcionario']) : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Essa função retorna os vetores 'erros' e 'dados'
	$validacao = $funcionario->validarFuncionario($_POST, $id_funcionario);

	if (count($validacao['erros']) == 0) {
		if ($id_funcionario) {
			$gravou = $funcionario->atualizarFuncionario($validacao['dados'], $id_funcionario);
		} else {
			$gravou = $funcionario->inserirFuncionario($validacao['dados']);
		}

		if ($gravou) {
			if ($id_funcionario) {
				header('Location: ../index.php?pagina=funcionario/editar&msg-usuario=3&id-funcionario=' . $id_funcionario);
			} else {
				header('Location: ../index.php?pagina=funcionario/cadastrar&msg-usuario=1');
			}
			exit();
		} else {
			if ($id_funcionario) {
				header('Location: ../index.php?pagina=funcionario/editar&msg-usuario=4&id-funcionario=' . $id_funcionario);
			} else {
				header('Location: ../index.php?pagina=funcionario/cadastrar&msg-usuario=2');
			}
			exit();
		}
	} else {
		//Passa por GET os erros na validação
		$parametrosErro = '';
		foreach ($validacao['erros'] as $i => $campo) {
			$parametrosErro .= '&erro' . $i . '=' . $campo;
		}

		if ($id_funcionario) {
			header('Location: ../index.php?pagina=funcionario/editar' . $parametrosErro . '&id-funcionario=' . $id_funcionario);
		} else{
			header('Location: ../index.php?pagina=funcionario/cadastrar' . $parametrosErro);
		}
		exit();
	}
} else {
	//Se o envio dos dados não for pelo método POST, o usuário é redirecionado para página de cadastro
	header('Location: ../index.php?pagina=funcionario/cadastrar');
	exit;
}