<div class="d-flex flex-column">
	<label class="col text-center my-4">
		<h5>Novo Usuário</h5>
	</label>

	<div class="row">
		<div class="form-group col mt-4 table-responsive">
			<input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-12 col-lg-3">
			<label for="nome">Nome</label>
			<input required type="text" class="form-control col-12" name="nome" id="nome">
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="sobrenome">Sobrenome</label>
			<input required type="text" class="form-control col-12" name="sobrenome" id="sobrenome">
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="email">E-mail</label>
			<input required type="email" class="form-control col-12" name="email" id="email">
		</div>
	
		<div class="form-group col-12 col-lg-3">
			<label for="email">Confirme o e-mail</label>
			<input required type="email" class="form-control col-12" name="c_email" id="c_email">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-12 col-lg-4">
			<label for="nome">Usuário</label>
			<input required type="text" class="form-control col-12" name="nome" id="nome">
		</div>
	
		<div class="form-group col-12 col-lg-4">
			<label for="senha">Senha</label>
			<input required type="password" class="form-control col-12" name="senha" id="senha">
		</div>
	
		<div class="form-group col-12 col-lg-4">
			<label for="c_senha">Conrfirme a senha</label>
			<input required type="password" class="form-control col-12" name="c_senha" id="c_senha">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-12 col-lg-6">
			<label for="tipo">Tipo</label>
			<select class="form-control col-12" name="tipo" id="tipo">
				<option value="0">Selecione</option>
				<option value="1">Administrador</option>
				<option value="2">Usuário</option>
			</select>
		</div>

		<div class="form-group col-12 col-lg-6">
			<label for="id_inst">Instituição</label>
			<select class="form-control col-12" name="id_inst" id="id_inst">
				<option value="0">Selecione</option>
				<option value="1">UDF - Centro Universitario</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col my-1">
			<input type="button" onclick="insereUser();" class="btn btn-primary col-12" name="agendar" value="Agendar">
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