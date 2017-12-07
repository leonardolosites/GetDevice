/*-------------FUNCOES DE VALIDACAO------------------*/

/*Validar e-mail recebido em parametro*/
function validaEmail(email){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
	    return false;
	}else{
		return true;
	}
}
/*Valida um usuario recebido no parametro*/
function validaUser(user){
	var re = /^[a-zA-Z]/;
	if (user.length < 6 || !re.exec(user)) {
	    return false;
	}else{
		return true;
	}
}
/*Valida campos de formulario*/
function validaCampo(campo, msg, type, alert){
	if(type === null){
		type = 'text';
	}

    if(alert === null){
        type = 'warning';
    }

	var pai = $(campo).parent();
	var valor = $(campo).val();
	var label = pai.find(".form-control-feedback");

	switch (type) {
		case 'text':
			if(valor == "" || valor == 0){
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-'+alert);
				$(campo).removeClass('form-control-success');
				$(campo).addClass('form-control-'+alert);
				label.removeClass('d-none').empty().append("<small>"+msg+"</small>");
				return false;
			}else{
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-success');
				$(campo).removeClass('form-control-'+alert);
				$(campo).addClass('form-control-success');
				label.addClass('d-none').empty();
				return true;
			}
		break;
		case 'email':
			if(valor == ""){
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-'+alert);
				$(campo).removeClass('form-control-success');
				$(campo).removeClass('form-control-danger');
				$(campo).removeClass('form-control-warning');
				$(campo).addClass('form-control-'+alert);
				label.removeClass('d-none').empty().append("<small>"+msg+"</small>");
				return false;
			}else if(!validaEmail(valor)){
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-danger');
				$(campo).removeClass('form-control-success');
				$(campo).removeClass('form-control-danger');
				$(campo).removeClass('form-control-warning');
				$(campo).addClass('form-control-danger');
				$(campo).select();
				label.removeClass('d-none').empty().append("<small>Informe um e-mail válido!</small>");
				return false;
			}else{
				$.post(
					"/controller/verifica-duplicidade.php",
					"tabela=usuario&usuario&email="+valor,
					function (data) {
						if(data == 'sim'){
							pai.removeClass('has-success');
							pai.removeClass('has-danger');
							pai.removeClass('has-warning');
							pai.addClass('has-danger');
							$(campo).removeClass('form-control-success');
							$(campo).removeClass('form-control-danger');
							$(campo).removeClass('form-control-warning');
							$(campo).addClass('form-control-danger');
							$(campo).select();
							label.removeClass('d-none').empty().append("<small>E-mail já cadastrado no sistema</small>");
							return false;
						}else{
							pai.removeClass('has-success');
							pai.removeClass('has-danger');
							pai.removeClass('has-warning');
							pai.addClass('has-success');
							$(campo).removeClass('form-control-success');
							$(campo).removeClass('form-control-danger');
							$(campo).removeClass('form-control-warning');
							$(campo).addClass('form-control-success');
							label.addClass('d-none').empty();
							return true;
						}
					}
				);
			}
		break;
		case 'c_email':
			if(validaCampo(campo, msg)){
				if(valor != $("#email").val()){
					pai.removeClass('has-success');
					pai.removeClass('has-danger');
					pai.removeClass('has-warning');
					pai.addClass('has-danger');
					$(campo).removeClass('form-control-success');
					$(campo).removeClass('form-control-danger');
					$(campo).removeClass('form-control-warning');
					$(campo).addClass('form-control-danger');
					$(campo).select();
					label.removeClass('d-none').empty().append("<small>E-mails diferentes!</small>");
					return false;
				}else{
					pai.removeClass('has-success');
					pai.removeClass('has-danger');
					pai.removeClass('has-warning');
					pai.addClass('has-success');
					$(campo).removeClass('form-control-success');
					$(campo).removeClass('form-control-danger');
					$(campo).removeClass('form-control-warning');
					$(campo).addClass('form-control-success');
					label.addClass('d-none').empty();
					return true;
				}
			}
		break;
		case 'c_senha':
			if(validaCampo(campo, msg)){
				if(valor != $("#senha").val()){
					pai.removeClass('has-success');
					pai.removeClass('has-danger');
					pai.removeClass('has-warning');
					pai.addClass('has-danger');
					$(campo).removeClass('form-control-success');
					$(campo).removeClass('form-control-danger');
					$(campo).removeClass('form-control-warning');
					$(campo).addClass('form-control-danger');
					$(campo).select();
					label.removeClass('d-none').empty().append("<small>Senhas diferentes!</small>");
					return false;
				}else{
					pai.removeClass('has-success');
					pai.removeClass('has-danger');
					pai.removeClass('has-warning');
					pai.addClass('has-success');
					$(campo).removeClass('form-control-success');
					$(campo).removeClass('form-control-danger');
					$(campo).removeClass('form-control-warning');
					$(campo).addClass('form-control-success');
					label.addClass('d-none').empty();
					return true;
				}
			}
		break;
		case 'user':
			if(valor == ""){
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-'+alert);
				$(campo).removeClass('form-control-success');
				$(campo).removeClass('form-control-danger');
				$(campo).removeClass('form-control-warning');
				$(campo).addClass('form-control-'+alert);
				label.removeClass('d-none').empty().append("<small>"+msg+"</small>");
				return false;
			}else if(!validaUser(valor)){
				pai.removeClass('has-success');
				pai.removeClass('has-danger');
				pai.removeClass('has-warning');
				pai.addClass('has-danger');
				$(campo).removeClass('form-control-success');
				$(campo).removeClass('form-control-danger');
				$(campo).removeClass('form-control-warning');
				$(campo).addClass('form-control-danger');
				$(campo).select();
				pai.find(".form-text").addClass('text-info');
				label.removeClass('d-none').empty().append("<small>Usuário inválido!</small>");
				return false;
			}else{
				$.post(
					"/controller/verifica-duplicidade.php",
					"tabela=usuario&email&usuario="+valor,
					function (data) {
						if(data == 'sim'){
							pai.removeClass('has-success');
							pai.removeClass('has-danger');
							pai.removeClass('has-warning');
							pai.addClass('has-danger');
							$(campo).removeClass('form-control-success');
							$(campo).removeClass('form-control-danger');
							$(campo).removeClass('form-control-warning');
							$(campo).addClass('form-control-danger');
							$(campo).select();
							label.removeClass('d-none').empty().append("<small>Usuário já cadastrado no sistema</small>");
							return false;
						}else{
							pai.removeClass('has-success');
							pai.removeClass('has-danger');
							pai.removeClass('has-warning');
							pai.addClass('has-success');
							$(campo).removeClass('form-control-success');
							$(campo).removeClass('form-control-danger');
							$(campo).removeClass('form-control-warning');
							$(campo).addClass('form-control-success');
							label.addClass('d-none').empty();
							return true;
						}
					}
				);
			}
		break;
	}
}

/*------------------FUNCOES DE CRUD NO BANCO---------------------*/
/*Cancela um agendamento pelo id passado por parametro*/
function statusUser(id_usuario, id_instituicao, acao){
	$("#modalConfirmacao").modal('toggle');
	$("#btnSim").click(function() {
		if(acao == 'enable'){
			$.post(
				"/controller/ativa-conta-usuario.php",
				"id_usuario="+id_usuario+"&id_instituicao="+id_instituicao+"&acao=1",
				function (retorno) {
					if(retorno == 'ok'){
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Usuário habilitado com sucesso!", "success"));
						window.setTimeout(function(){
							location.reload();
						}, 2000);
						$("#modalConfirmacao").modal('toggle');
					}else{
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Não foi possível habilitar o usuário!<br>Detalhes:"+retorno, "danger"));
						window.setTimeout(function(){
							location.reload();
						}, 10000);
					}
				}
			);
		}else{
			$.post(
				"/controller/ativa-conta-usuario.php",
				"id_usuario="+id_usuario+"&id_instituicao="+id_instituicao+"&acao=0",
				function (retorno) {
					if(retorno == 'ok'){
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Usuário desabilitado com sucesso!", "success"));
						window.setTimeout(function(){
							location.reload();
						}, 2000);
						$("#modalConfirmacao").modal('toggle');
					}else{
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Não foi possível desabilitar o usuário!<br>Detalhes:"+retorno, "danger"));
						window.setTimeout(function(){
							location.reload();
						}, 10000);
					}
				}
			);
		}
	});
}


function cancelaAgd(id, idInst, idUser){
	// noinspection JSJQueryEfficiency
    $("#modalConfirmacao").modal('toggle');
	// noinspection JSJQueryEfficiency
    $("#modalConfirmacao").on('shown.bs.modal', function () {
		$("#btnSim").click(function() {
			$.post(
				"/controller/cancela-agendamento.php",
				"id="+id+"&id_instituicao="+idInst+"&idUser="+idUser,
				function (retorno) {
					if(retorno == 'ok'){
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Agendamento cancelado com sucesso!", "success"));
						window.setTimeout(function(){
							location.reload();
						}, 2000);
						$("#modalConfirmacao").modal('toggle');
					}else{
						// noinspection JSJQueryEfficiency
                        $("#retorno").empty();
						// noinspection JSJQueryEfficiency
                        $("#retorno").append(mensagem("Não foi possível cancelar o agendamento!<br>Detalhes:"+retorno, "danger"));
						window.setTimeout(function(){
							location.reload();
						}, 10000);
					}
				}
			);
		});
	});
}
/*Insere um usuário no banco*/
function insereUser(){
	// noinspection JSJQueryEfficiency
    $("#retorno").empty();
	var nome = $("#nome").val();
	var sobrenome = $("#sobrenome").val();
	var email = $("#email").val();
	var c_email = $("#c_email").val();
	var usuario = $("#usuario").val();
	var senha = $("#senha").val();
	var c_senha = $("#c_senha").val();
	var tipo = $("#tipo").val();
	var id_inst = $("#id_inst").val();

	if(nome === '' || sobrenome === '' || email === '' || c_email === '' || usuario  === '' || senha  === '' || c_senha  === '' || tipo  === '0' || id_inst === '0'){
		$(".form-control").each(function(){
			if($(this).val() === ''){
				$(this).focus();
				return false;
			}
		});
		$("#retorno").append(mensagem("Todos os campos são obrigatórios!", "danger"));
	}else{
		$("#modalCarregando").modal('toggle');
		$.post(
			"/controller/insere-novo-usuario.php",
			"cadastrar&nome="+nome+"&sobrenome="+sobrenome+"&email="+email+"&usuario="+usuario+"&senha="+senha+"&tipo="+tipo+"&id_inst="+id_inst,
			function (result) {
                $("#modalCarregando").modal('toggle');
				if(result === 'ok'){
					$("#retorno").append(mensagem("Usuário cadastrado com sucesso!", "success"));
					window.setTimeout(function(){
						location.href="?page=usuarios";
					}, 2000);
				}else{
					$("#retorno").append(result);
					window.setTimeout(function(){
						location.reload();
					}, 10000);
				}
			});
	}
}
/*Inseror agendamento no banco*/
function insereAgd(idUser, idInst){
	var qnt = $("#quantidadeDispositivosAgendamento").val();
	var data = $("#dataAgendamento").val();
	var horaInicio = $("#horaInicioAgendamento").val();
	var horaFim = $("#horaFimAgendamento").val();

	if(qnt === 0){
		// noinspection JSJQueryEfficiency
        $("#retorno").empty();
		// noinspection JSJQueryEfficiency
        $("#retorno").append(mensagem("Informe a quantidade de dispositivos!", "info"));
	}else if(data === ''){
		// noinspection JSJQueryEfficiency
        $("#retorno").empty();
		// noinspection JSJQueryEfficiency
        $("#retorno").append(mensagem("Informe uma data para o agendamento!", "warning"));
	}else if(horaInicio === ''){
		// noinspection JSJQueryEfficiency
        $("#retorno").empty();
		// noinspection JSJQueryEfficiency
        $("#retorno").append(mensagem("Informe o horário inicial do agendamento!", "info"));
	}else if(horaFim === ''){
		// noinspection JSJQueryEfficiency
        $("#retorno").empty();
		// noinspection JSJQueryEfficiency
        $("#retorno").append(mensagem("Informe o horário final do agendamento!", "warning"));
	}else{
        $("#modalCarregando").modal('toggle');
		$.post(
			"/controller/insere-novo-agendamento.php",
			"agendar&qnt="+qnt+"&data="+data+"&horaInicio="+horaInicio+"&horaFim="+horaFim+"&idUser="+idUser+"&idInst="+idInst,
			function (retorno) {
                $("#modalCarregando").modal('toggle');
				if(retorno === 'ok'){
					// noinspection JSJQueryEfficiency
                    $("#retorno").empty();
					// noinspection JSJQueryEfficiency
                    $("#retorno").append(mensagem("Agendamento realizado com sucesso!", "success"));
					window.setTimeout(function(){
						location.href="?page=agendamentos";
					}, 2000);
				}else{
					// noinspection JSJQueryEfficiency
                    $("#retorno").empty();
					// noinspection JSJQueryEfficiency
                    $("#retorno").append(mensagem("Não foi possível registrar o agendamento!<br>"+retorno, "danger"));
					window.setTimeout(function(){
						location.reload();
					}, 10000);
				}
			}
		);
	}

}
/*Insere uma instituicao no banco*/
function insereInst(){
	// noinspection JSJQueryEfficiency
    $("#retorno").empty();
	// noinspection JSJQueryEfficiency
    var nome = $("#nome").val();
	// noinspection JSJQueryEfficiency
    var endereco = $("#endereco").val();
	// noinspection JSJQueryEfficiency
    var dispositivos = $("#dispositivos").val();

	if(nome == ''){
		$("#retorno").append(mensagem("Informe um nome para a instituição!", "info"));
		$("#nome").focus();
	}else if(endereco == ''){
		$("#retorno").append(mensagem("Informe um endereço!", "warning"));
		$("#endereco").focus();
	}else if(dispositivos == '') {
        $("#retorno").append(mensagem("Informe a quantidade de dispositivos!", "info"));
        $("#dispositivos").focus();
    }else{
		$("#modalCarregando").modal('toggle');
		$.post(
			"/controller/insere-nova-instituicao.php",
			"cadastrar&nome="+nome+"&endereco="+endereco+"&dispositivos="+dispositivos,
			function (result) {
                $("#modalCarregando").modal('toggle');
				if(result == 'ok'){
					$("#retorno").append(mensagem("Instituição cadastrada com sucesso!", "success"));
					window.setTimeout(function(){
						location.href="?page=instituicoes";
					}, 2000);
				}else{
					$("#retorno").append(result);
					window.setTimeout(function(){
						location.reload();
					}, 10000);
				}
			});
	}

}
/*--------FUNCOES DE UTILIZACAO GERAL---------*/
function cancela(page){
    // noinspection JSJQueryEfficiency
    $("#modalConfirma").modal('toggle');
    // noinspection JSJQueryEfficiency
    $("#modalConfirma").on('shown.bs.modal', function () {
        $("#btnSimConfirmacao").click(function() {
            location.href="?page="+page;
        });
    });
}

function mensagem($msg, $type){
	var $mensagem = '<div class="row-12 text-center"><div class="alert alert-'+$type+'" role="alert">'+$msg+'</div></div>';
	return $mensagem;
}

function explodeURL(){
    var url = location.search.slice(1);
    var partes = url.split('&');
    var data = {};
    partes.forEach(function (parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;
    });
    return data;
}

/*EXECUTADO QUANDO A PAGINA CARREGA*/
$(document).ready(function(){
var infoURL = explodeURL();

	switch(infoURL['page']){
		case 'cadastrar-usuario':
			/*Valida os campos*/
			$("#nome").focusout(function(event) {
				validaCampo("#nome", "Informe um nome!");
			});

			$("#sobrenome").focusout(function(event) {
				validaCampo("#sobrenome", "Informe um sobrenome!");
			});

			$("#email").focusout(function(event) {
				validaCampo("#email", "Informe um email!", 'email');
			});

			$("#c_email").focusout(function(event) {
				validaCampo("#c_email", "Confirme o e-mail!", 'c_email');
			});


			$("#id_inst").focusout(function(event) {
				validaCampo("#id_inst", "Selecione uma instituição");
			});

			$("#tipo").focusout(function(event) {
				validaCampo("#tipo", "Selecione um tipo");
			});

			$("#usuario").focusout(function(event) {
				validaCampo("#usuario", "Informe um usário!", 'user');
			});

			$("#senha").focusout(function(event) {
				validaCampo("#senha", "Informe uma senha!");
			});

			$("#c_senha").focusout(function(event) {
				validaCampo("#c_senha", "Confirme a senha digitada!", 'c_senha');
			});
		break;
	}

});