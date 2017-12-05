function cancela(page){
    $("#modalConfirma").modal('toggle');
    $("#modalConfirma").on('shown.bs.modal', function () {
        $("#btnSimConfirmacao").click(function() {
            location.href="?page="+page;
        });
    });
}


function cancelaAgd(id, idInst){
	$("#modalConfirmacao").modal('toggle');
	$("#modalConfirmacao").on('shown.bs.modal', function () {
		$("#btnSim").click(function() {
			$.post(
				"/controller/cancela-agendamento.php",
				"id="+id+"&id_instituicao="+idInst,
				function (retorno) {
					if(retorno == 'ok'){
						$("#retorno").empty();
						$("#retorno").append(mensagem("Agendamento cancelado com sucesso!", "success"));
						window.setTimeout(function(){
							location.reload();
						}, 2000);
						$("#modalConfirmacao").modal('toogle');
					}else{
						$("#retorno").empty();
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

function insereAgd(idUser, idInst){
	var qnt = $("#quantidadeDispositivosAgendamento").val();
	var data = $("#dataAgendamento").val();
	var horaInicio = $("#horaInicioAgendamento").val();
	var horaFim = $("#horaFimAgendamento").val();

	if(qnt == 0){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe a quantidade de dispositivos!", "info"));
	}else if(data == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe uma data para o agendamento!", "warning"));
	}else if(horaInicio == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe o horário inicial do agendamento!", "info"));
	}else if(horaFim == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe o horário final do agendamento!", "warning"));
	}else{
        $("#modalCarregando").modal('toggle');
		$.post(
			"/controller/insere-novo-agendamento.php",
			"agendar&qnt="+qnt+"&data="+data+"&horaInicio="+horaInicio+"&horaFim="+horaFim+"&idUser="+idUser+"&idInst="+idInst,
			function (retorno) {
                $("#modalCarregando").modal('toggle');
				if(retorno == 'ok'){
					$("#retorno").empty();
					$("#retorno").append(mensagem("Agendamento realizado com sucesso!", "success"));
					window.setTimeout(function(){
						location.href="?page=agendamentos";
					}, 2000);
				}else{
					$("#retorno").empty();
					$("#retorno").append(mensagem("Não foi possível registrar o agendamento!<br>"+retorno, "danger"));
					window.setTimeout(function(){
						location.reload();
					}, 10000);
				}
			}
		);
	}

}

function insereUser(){
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

	if(nome == ''){
		$("#retorno").append(mensagem("Informe um nome!", "info"));
		$("#nome").focus();
	}else if(sobrenome == ''){
		$("#retorno").append(mensagem("Informe um sobrenome!", "warning"));
		$("#sobrenome").focus();
	}else if(email == '') {
        $("#retorno").append(mensagem("Informe um e-mail!", "info"));
        $("#email").focus();
    }else if(c_email == ''){
		$("#retorno").append(mensagem("Confirme o e-mail!", "warning"));
		$("#c_email").focus();
	}else if(c_email != email){
        $("#retorno").append(mensagem("Os e-mails informados são diferentes!", "danger"));
        $("#c_email").focus();
        $("#c_email").select();
    }else if(usuario == ''){
		$("#retorno").append(mensagem("Informe um usuário!", "info"));
		$("#usuario").focus();
	}else if(senha == ''){
		$("#retorno").append(mensagem("Informe uma senha!", "warning"));
		$("#senha").focus();
	}else if(c_senha == ''){
		$("#retorno").append(mensagem("Confirme a senha!", "info"));
		$("#c_senha").focus();
	}else if(c_senha != senha){
        $("#retorno").append(mensagem("As senhas informados são diferentes!", "danger"));
        $("#c_senha").focus();
        $("#c_senha").select();
    }else if(tipo == 0){
		$("#retorno").append(mensagem("Selecione um tipo!", "warning"));
		$("#tipo").focus();
	}else if(id_inst == 0){
		$("#retorno").append(mensagem("Selecione a instituição!", "info"));
		$("#id_inst").focus();
	}else{
		$("#modalCarregando").modal('toggle');
		$.post(
			"/controller/insere-novo-usuario.php",
			"cadastrar&nome="+nome+"&sobrenome="+sobrenome+"&email="+email+"&usuario="+usuario+"&senha="+senha+"&tipo="+tipo+"&id_inst="+id_inst,
			function (result) {
                $("#modalCarregando").modal('toggle');
				if(result == 'ok'){
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

function insereInst(){
	$("#retorno").empty();
	var nome = $("#nome").val();
	var endereco = $("#endereco").val();
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

function mensagem($msg, $type){
	var $mensagem = '<div class="row-12 text-center"><div class="alert alert-'+$type+'" role="alert">'+$msg+'</div></div>';
	return $mensagem;
}

$(document).ready(function(){
	
});