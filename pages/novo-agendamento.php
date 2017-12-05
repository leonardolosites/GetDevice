<div class="d-flex flex-column">
	<label class="col text-center my-4">
		<h5>Novo Agendamento</h5>
	</label>

	<div class="row">
		<div class="form-group col mt-4 table-responsive">
			<input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-12 col-lg-3">
			<label for="quantidadeDispositivosAgendamento">Quer quantos dispositivos?</label>
			<select class="form-control col-12" name="quantidadeDispositivosAgendamento" id="quantidadeDispositivosAgendamento">
				<?php 
					$sqlLista = "SELECT dispositivos_disponiveis_instituicao FROM instituicao WHERE id_instituicao = {$id_instituicao}"; 

					try {

						require_once("bd/conexao.php");

						$total = $conn->query($sqlLista)->fetch();
						for($i = 0; $i <= $total['dispositivos_disponiveis_instituicao']; $i++){
							$lista .= '<option value="'.$i.'">'.$i.'</option>';
						}
						
						echo $lista;

					} catch (Exception $e) {
						$msg = "Erro ao inserir agendamento! <br>Detalhes: ".$e->getMessage();
						echo '<option>'.$msg.'</option>';
					}
				?>
			</select>
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="dataAgendamento">Em que data?</label>
			<input required type="date" class="form-control col-12" name="dataAgendamento" id="dataAgendamento">
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="horaInicioAgendamento">E qual horário?</label>
			<input required type="time" class="form-control col-12" name="horaInicioAgendamento" id="horaInicioAgendamento">
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="horaFimAgendamento">Até que horas?</label>
			<input required type="time" class="form-control col-12" name="horaFimAgendamento" id="horaFimAgendamento">
		</div>
	</div>

	<div class="row">
		<div class="col my-1">
			<input type="button" onclick="insereAgd(<?=$userId?>, <?=$id_instituicao?>);" class="btn btn-primary col-12" name="agendar" value="Agendar">
		</div>
		<div class="col my-1">
			<a href="/?page=agendamentos" class="btn btn-warning col-12">Ver Agendamentos</a>
		</div>
	</div>
    <div id="modalCarregando" class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-body">
                <img src="images/loading2.gif" alt="Carregando" width="100%">
            </div>
        </div>
    </div>
</div>