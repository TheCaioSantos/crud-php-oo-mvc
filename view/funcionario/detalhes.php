<?php 
if (empty($_SESSION)) {
	session_start();
}

#Verifica se o usuário está logado
if (empty($_SESSION['id_usuario'])) {
	header("Location: ../../login.php");
	exit();
}

if (isset($_GET['id-funcionario']) && $id_funcionario = trim($_GET['id-funcionario'])) {
	require_once "model/Conexao.php";
	require_once 'model/Funcionario.php';
	$funcionario = new Funcionario;
	$dados = $funcionario->consultarFuncionario($id_funcionario);
} else {
	header("Location: index.php");
}
?>

<div class="row justify-content-center">
	<div class="col-md-8 col-12">
		<div class="bloco-1">
			<h2 class="display-4 titulo-pagina">Detalhes do Funcionário</h2>

			<div class="row">
				<div class="col-6 col-md-4">
					<label><b>Nome</b></label>
					<p class="text-muted"><?php echo $dados['nome_funcionario'] ?></p>
				</div>

				<div class="col-6 col-md-4">
					<label><b>Cargo</b></label>
					<p class="text-muted"><?php echo $dados['nome_cargo'] ?></p>
				</div>

				<div class="col-6 col-md-4">
					<label><b>Modo de Trabalho</b></label>
					<p class="text-muted"><?php echo $dados['modo_de_trabalho_funcionario'] ?></p>
				</div>

				<div class="col-6 col-md-4">
					<label><b>Data de Inicio</b></label>
					<p class="text-muted"><?php echo date('d/m/Y',strtotime($dados['data_inicio_funcionario'])) ?></p>
				</div>

				<div class="col-6 col-md-4">
					<label><b>Cadastrado Por</b></label>
					<p class="text-muted"><?php echo $dados['nome_usuario'] ?></p>
				</div>

				<div class="button-group col-12">
					<a href="?pagina=funcionario/listar" class="btn waves-effect waves-light btn-danger">Voltar</a>
				</div>
			</div>
		</div>
	</div>
</div>