<?php 
if (empty($_SESSION)) {
	session_start();
}

#Verifica se o usuário está logado
if (empty($_SESSION['id_usuario'])) {
	header("Location: ../../login.php");
	exit();
}
 ?>

 <div class="row justify-content-center">
	<div class="col-md-8 col-12">
		<div class="bloco-1">
			<h2 class="display-4 titulo-pagina">Cadastrar Funcionário</h2>

			<!-- Mensagens para o usuário -->
			<?php if (isset($_GET['msg-usuario']) && $_GET['msg-usuario'] == '1'): ?>
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-12 mensagem">
					Funcionário cadastrado com sucesso.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>

			<?php if (isset($_GET['msg-usuario']) && $_GET['msg-usuario'] == '2'): ?>
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-12 mensagem">
					Erro ao tentar Cadastrar.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>

			<?php
			if (count($_GET) > 1) {
				unset($_GET['pagina']);
				foreach ($_GET as $i => $campo) {
					if ($campo == 'nome-funcionario') {
						echo '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-3 col-sm-12 mensagem-campo">
						O NOME deve ser preenchido.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} elseif ($campo == 'id-cargo') {
						echo '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-3 col-sm-12 mensagem-campo">
						O CARGO deve ser preenchido.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} elseif ($campo == 'modo-de-trabalho') {
						echo '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-3 col-sm-12 mensagem-campo">
						O MODO DE TRABALHO deve ser preenchido.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} elseif ($campo == 'data-inicio') {
						echo '
						<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-lg-3 col-sm-12 mensagem-campo">
						A DATA deve ser preenchido.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					}
				}
			}
			?>

			<div class="card-body">
				<form class="form-material row" action="controller/funcionario.php" method="POST">

					<div class="form-group col-md-4 m-t-20">
						<input type="text" name="nome-funcionario" class="form-control form-control-line" placeholder="Nome"> 
					</div>

					<div class="form-group col-md-4 m-t-30">
						<select class="form-control col-md-12" name="id-cargo">
							<option value="">Cargo</option>
							<?php 
							require_once "model/Conexao.php";
							require_once "model/Funcionario.php";
							$cargosFuncionario = new Funcionario();

							$cargos = $cargosFuncionario->consultarCargos();
							?>

							<?php foreach ($cargos as $cargo) : ?>
								<option value="<?php echo $cargo['id_cargo']; ?>"><?php echo $cargo['nome_cargo']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group col-md-4 m-t-30">
						<select class="form-control col-md-12" name="modo-de-trabalho">
							<option value="">Modo de Trabalho</option>
							<option value="Local">Local</option>
							<option value="Home Office">Home Office</option>
						</select>
					</div>

					<div class="form-group col-md-4 m-t-30">
						<label>Data de Inicio</label>
						<input name="data-inicio" type="date" class="form-control" placeholder="dd/mm/yyyy">
					</div>

					<div class="button-group col-12">
						<button type="submit" class="btn waves-effect waves-light btn-success">Cadastrar</button>
						<a href="?pagina=funcionario/listar" class="btn waves-effect waves-light btn-danger">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>