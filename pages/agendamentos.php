<div class="d-flex flex-column">
	<label class="col text-center my-4">
		<h5><?=($userType == 2 ? 'Meus ' : '' )?>Agendamentos</h5>
	</label>

	<div class="row">
		<div class="form-group col mt-4 table-responsive">
			<input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
		</div>
	</div>

	<div class="row">
		<div class="col table-responsive">
			<table class="table-bordered table-striped table">
				<thead>
					<tr>
						<th>Usuário</th>
						<th>Dispositivos</th>
						<th>Data Agendada</th>
						<th>Hora Inicial</th>
						<th>Hora Final</th>
						<th>**</th>
					</tr>
				</thead>
				<tbody>
					<?php include("/controller/lista-agendamentos.php");?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row <?=($userType == 1 ? 'd-none' : '' )?>">
		<div class="col my-1">
			<a href="/?page=home" class="btn btn-info col-12">Novo Agendamento</a>
		</div>
	</div>

</div>

<div id="modalConfirmacao" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmação</h5>
			</div>
			<div class="modal-body">
				<p class="text-center">Deseja realmente cancelar este agendamento?</p>
				<p class="small text-center text-danger">Esta ação não poderá ser desfeita.</p>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSim" class="btn btn-primary">Sim</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
			</div>
			</div>
	</div>
</div>