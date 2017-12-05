<div class="d-flex flex-column">
	<label class="col text-center my-4">
		<h5>Usuários</h5>
	</label>

	<div class="row">
		<div class="form-group col mt-3 table-responsive">
			<input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
		</div>
	</div>

	<div class="row">
		<div class="col mt-2 mb-4">
			<a href="/?page=cadastrar-usuario" class="btn btn-info col-12">Novo Usuário</a>
		</div>
	</div>

	<div class="row">
		<div class="col table-responsive">
			<table class="table-bordered table-striped table">
				<thead>
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>E-mail</th>
						<th>Tipo</th>
						<th>Usuário</th>
						<th>Status</th>
						<th class="text-center" colspan="2">Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php include("/controller/lista-usuarios.php");?>
				</tbody>
			</table>
		</div>
	</div>

</div>