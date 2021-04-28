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
			<h2 class="display-4 titulo-pagina">Editar Funcionário</h2>

			<!-- Mensagens para o usuário -->
			<?php if (isset($_GET['msg-usuario']) && $_GET['msg-usuario'] == '4'): ?>
				<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show text-center col-12 mensagem">
					Erro ao tentar atualizar.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>

			<?php if (isset($_GET['msg-usuario']) && $_GET['msg-usuario'] == '3'): ?>
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-12 mensagem">
					Funcionário atualizado com sucesso.
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
				<form class="form-material row" action="controller/funcionario.php<?php echo isset($_GET['id-funcionario']) ? '?id-funcionario=' . $_GET['id-funcionario'] : ''; ?>" method="POST">


					<?php 

					if (isset($_GET['id-funcionario']) && $id_funcionario = trim($_GET['id-funcionario'])) {
						require_once "model/Conexao.php";
						require_once 'model/Funcionario.php';
						$funcionario = new Funcionario;

						$dados = $funcionario->consultarFuncionario($id_funcionario);
					} else {
						header("Location: index.php");
						exit();
					}

					?>

					<div class="form-group col-md-4 m-t-20">
						<input type="text" name="nome-funcionario" class="form-control form-control-line" placeholder="Nome" value="<?php echo $dados['nome_funcionario'] ?>"> 
					</div>

					<div class="form-group col-md-4 m-t-30">
						<select class="form-control col-md-12" name="id-cargo">
							<option value="">Cargo</option>
							<?php 

							$cargosFuncionario = new Funcionario();

							$cargos = $cargosFuncionario->consultarCargos();
							?>

							<?php foreach ($cargos as $cargo) : ?>
								<?php if (isset($dados) && $dados['id_cargo'] == $cargo['id_cargo']): ?>
									<option value="<?php echo $dados['id_cargo']; ?>" selected><?php echo $dados['nome_cargo']; ?></option>
									<?php else: ?>
										<option value="<?php echo $cargo['id_cargo']; ?>"><?php echo $cargo['nome_cargo']; ?></option>
									<?php endif ?>
								<?php endforeach; ?>
							</select>
						</div>

						<?php
						$modo_de_trabalho = array(
							'1' => 'Local',
							'2' => 'Home Office',
						);
						?>

						<div class="form-group col-md-4 m-t-30">
							<select class="form-control col-md-12" name="modo-de-trabalho">
								<option value="">Modo de Trabalho</option>
								<?php foreach ($modo_de_trabalho as $posicai => $valor): ?>
									<?php if (isset($dados) && $dados['modo_de_trabalho_funcionario'] == $valor): ?>
										<option value="<?php echo $valor ?>" selected><?php echo $valor ?></option>
										<?php else: ?>
											<option value="<?php echo $valor ?>"><?php echo $valor ?></option>
										<?php endif; ?>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group col-md-4 m-t-30">
								<label>Data de Inicio</label>
								<input name="data-inicio" type="date" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo $dados['data_inicio_funcionario'] ?>">
							</div>

							<div class="button-group col-12">
								<button type="submit" class="btn waves-effect waves-light btn-success">Atualizar</button>
								<a href="?pagina=funcionario/listar" class="btn waves-effect waves-light btn-danger">Cancelar</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>