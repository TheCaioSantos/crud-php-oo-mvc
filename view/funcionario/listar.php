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

 <div class="row d-flex justify-content-center text-center">
	<div class="table-responsive col-md-8 col-12">
		<h4 class="card-title"></li> Lista de Funcionários</h4>

		<?php 
		require_once "model/Conexao.php";
		require_once 'model/Funcionario.php';
		$funcionario = new Funcionario();

		$quantidade_por_pagina = 5;
		$page = isset($_GET['page']) && trim($_GET['page']) ? (int)$_GET['page'] : 1;
		$inicio = $quantidade_por_pagina * $page - $quantidade_por_pagina;

		$dados = $funcionario->consultarFuncionario(null, $inicio, $quantidade_por_pagina);
		?>

		<table class="table table-sm table-bordered table-condensed table-hover text-center">
			<!-- Mensagens para o usuário -->
			<?php if (isset($_GET['msg-remover']) && $_GET['msg-remover'] == '1'): ?>
				<div class="sufee-alert alert with-close alert-success alert-dismissible fade show text-center col-12 mensagem">
					Funcionário removido com sucesso.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>
			<thead>
				<tr>
					<th scope="col">Nome</th>
					<th scope="col">Cargo</th>
					<th scope="col">Modo de Trabalho</th>
					<th scope="col">Data de Inicio</th>
					<th scope="col">Ações</th>
				</tr>
			</thead>
			<tbody>

					<?php foreach ($dados as $dado): ?>
						<tr>
							<td><?php echo $dado['nome_funcionario'] ?></td>
							<td><?php echo $dado['nome_cargo'] ?> </td>
							<td><?php echo $dado['modo_de_trabalho_funcionario'] ?></td>
							<td><?php echo date('d/m/Y',strtotime($dado['data_inicio_funcionario'])) ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">
									<a href="index.php?pagina=funcionario/detalhes&id-funcionario=<?php echo $dado['id_funcionario']; ?>" class="btn btn-success btn-sm btn-secondary">
										Detalhes
									</a>
									<a href="index.php?pagina=funcionario/editar&id-funcionario=<?php echo $dado['id_funcionario']; ?>" class="btn btn-warning btn-sm btn-secondary">
										Editar
									</a>
									<button type="button" class="btn btn-danger btn-sm btn-secondary" data-toggle="modal" data-target="#Modal-id-<?php echo $dado['id_funcionario']; ?>">
										Remover
									</button>
									<!-- Modal -->
									<div class="modal fade" id="Modal-id-<?php echo $dado['id_funcionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="TituloModalLongoExemplo">Deseja remover este funcionário?</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancelar</button>
													<a href="controller/funcionario.php?id-funcionario=<?php echo $dado['id_funcionario']; ?>&remover=true" class="btn btn-danger btn-sm btn-secondary">
														Remover
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>

			<nav>
				<ul class="pagination pagination-md justify-content-center">
					<?php 
					require_once "model/Funcoes.php";
					$funcoes = new Funcoes();
					$funcoes->paginacao("funcionario", "funcionario/listar", $quantidade_por_pagina);
					 ?>
				</ul>
			</nav>
		</div>
	</div>