<div class="d-flex flex-column">
    <label class="col text-center my-4">
        <h5>Nova Instituição</h5>
    </label>

    <div class="row">
        <div class="form-group col mt-4 table-responsive">
            <input class="form-control text-center col-12" disabled value="<?=$informacoes?>">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 col-lg-4">
            <label for="nome">Nome</label>
            <input autofocus required type="text" class="form-control col-12" name="nome" id="nome">
        </div>

        <div class="form-group col-12 col-lg-4">
            <label for="endereco">Endereço</label>
            <input required type="text" class="form-control col-12" name="endereco" id="endereco">
        </div>

        <div class="form-group col-12 col-lg-4">
            <label for="dispositivos">Quantidade de dispositivos</label>
            <input required type="number" class="form-control col-12" name="dispositivos" id="dispositivos">
        </div>

    </div>

    <div class="row">
        <div class="col my-1">
            <input type="button" onclick="cancela('instituicoes');" class="btn btn-danger col-12" value="Cancelar">
        </div>
        <div class="col my-1">
            <input type="button" onclick="insereInst();" class="btn btn-primary col-12" value="Salvar">
        </div>
    </div>
</div>