<div class="d-flex flex-column">
	<label class="col text-center my-4">
		<h5>Instituições</h5>
	</label>

	<div class="row">
		<div class="form-group col mt-3 table-responsive">
			<input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
		</div>
	</div>

	<div class="row">
		<div class="col mt-2 mb-4">
			<a href="/?page=nova-instituicao" class="btn btn-info col-12">Nova Instituição</a>
		</div>
	</div>

	<div class="row">
		<div class="col table-responsive">
			<table class="table-bordered table-striped table">
				<thead>
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Endereço</th>
						<th>Quantidade de Dispositivos</th>
					</tr>
				</thead>
				<tbody>
					<?php include("/controller/lista-instituicoes.php");?>
				</tbody>
			</table>
		</div>
	</div>
</div>