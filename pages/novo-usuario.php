<div id="formAddUser" class="d-flex flex-column">
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
            <label class="form-control-label" for="nome">Nome</label>
            <input autofocus required type="text" class="form-control col-12" name="nome" id="nome">
            <div class="form-control-feedback d-none"></div>
        </div>

        <div class="form-group col-12 col-lg-3">
            <label class="form-control-label" for="sobrenome">Sobrenome</label>
            <input required type="text" class="form-control col-12" name="sobrenome" id="sobrenome">
            <div class="form-control-feedback d-none"></div>
        </div>

        <div class="form-group col-12 col-lg-3">
            <label class="form-control-label" for="email">E-mail</label>
            <input required type="text" class="form-control col-12" name="email" id="email">
            <div class="form-control-feedback d-none"></div>
        </div>

        <div class="form-group col-12 col-lg-3">
            <label class="form-control-label" for="email">Confirme o e-mail</label>
            <input required type="text" class="form-control col-12" name="c_email" id="c_email">
            <div class="form-control-feedback d-none"></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 col-lg-6">
            <label class="form-control-label" for="id_inst">Instituição</label>
            <select class="form-control col-12" name="id_inst" id="id_inst">
                <option value="0">Selecione</option>
                <?php
                $sqlLista = "SELECT * FROM instituicao ORDER BY nome_instituicao ASC";

                try {

                    require_once("bd/conexao.php");

                    $instituicao = $conn->query($sqlLista);
                    foreach ($instituicao as $inst){
                        echo '<option value="'.$inst["id_instituicao"].'">'.$inst["nome_instituicao"].'</option>';
                    }

                } catch (Exception $e) {
                    $msg = "Erro ao listas as instituições! <br>Detalhes: ".$e->getMessage();
                    echo '<option>'.$msg.'</option>';
                }
                ?>
            </select>
            <div class="form-control-feedback d-none"></div>
        </div>

        <div class="form-group col-12 col-lg-6">
            <label class="form-control-label" for="tipo">Tipo</label>
            <select class="form-control col-12" name="tipo" id="tipo">
                <option value="0">Selecione</option>
                <option value="1">Administrador</option>
                <option value="2">Usuário</option>
            </select>
            <div class="form-control-feedback d-none"></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12 col-lg-4">
            <label class="form-control-label" for="usuario">Usuário</label>
            <input required type="text" class="form-control col-12" name="usuario" id="usuario">
            <div class="form-control-feedback d-none"></div>
            <small class="form-text text-muted">Deve iniciar com letra e possuir no minimo 6 caracteres.</small>
        </div>

        <div class="form-group col-12 col-lg-4">
            <label class="form-control-label" for="senha">Senha</label>
            <input required type="password" class="form-control col-12" name="senha" id="senha">
            <div class="form-control-feedback d-none"></div>
        </div>

        <div class="form-group col-12 col-lg-4">
            <label class="form-control-label" for="c_senha">Conrfirme a senha</label>
            <input required type="password" class="form-control col-12" name="c_senha" id="c_senha">
            <div class="form-control-feedback d-none"></div>
        </div>
    </div>

    <div class="row">
        <div class="col my-1">
            <input type="button" onclick="cancela('usuarios');" class="btn btn-danger col-12" value="Cancelar">
        </div>
        <div class="col my-1">
            <input type="submit" onclick="insereUser();" id="btnAddUser" class="btn btn-primary col-12" value="Salvar">
        </div>
    </div>
</div>