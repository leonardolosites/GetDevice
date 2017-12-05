function cancelaAgd(id, idInst){
	$("#modalConfirmacao").modal('show');
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
						$("#modalConfirmacao").modal('hide');
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
	$("#modalCarregando").modal('toggle');
	var qnt = $("#quantidadeDispositivosAgendamento").val();
	var data = $("#dataAgendamento").val();
	var horaInicio = $("#horaInicioAgendamento").val();
	var horaFim = $("#horaFimAgendamento").val();

	if(qnt == 0){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe a quantidade de dispositivos!", "warning"));
	}else if(data == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe uma data para o agendamento!", "warning"));
	}else if(horaInicio == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe o horário inicial do agendamento!", "warning"));
	}else if(horaFim == ''){
		$("#retorno").empty();
		$("#retorno").append(mensagem("Informe o horário final do agendamento!", "warning"));
	}else{
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
	// $("#modalCarregando").modal('toggle');
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
		$("#retorno").append(mensagem("Informe um nome!", "warning"));
	}else if(sobrenome == ''){
		$("#retorno").append(mensagem("Informe um sobrenome!", "warning"));
	}else if(email == ''){
		$("#retorno").append(mensagem("Informe um e-mail!", "warning"));
	else if(c_email == ''){
		$("#retorno").append(mensagem("Confirme o e-mail!", "warning"));
	}else if(usuario == ''){
		$("#retorno").append(mensagem("Informe um usuário!", "warning"));
	}else if(senha == ''){
		$("#retorno").append(mensagem("Informe uma senha!", "warning"));
	}else if(c_senha == ''){
		$("#retorno").append(mensagem("Confirme a senha!", "warning"));
	}else if(tipo == 0){
		$("#retorno").append(mensagem("Selecione um tipo!", "warning"));
	}else if(id_inst == 0){
		$("#retorno").append(mensagem("Selecione a instituição!", "warning"));
	}else{
		// $.post(
		// 	"/controller/insere-novo-agendamento.php",
		// 	"agendar&qnt="+qnt+"&data="+data+"&horaInicio="+horaInicio+"&horaFim="+horaFim+"&idUser="+idUser+"&idInst="+idInst,
		// 	function (retorno) {
  //               $("#modalCarregando").modal('toggle');
		// 		if(retorno == 'ok'){
		// 			$("#retorno").empty();
		// 			$("#retorno").append(mensagem("Agendamento realizado com sucesso!", "success"));
		// 			window.setTimeout(function(){
		// 				location.href="?page=agendamentos";
		// 			}, 2000);
		// 		}else{
		// 			$("#retorno").empty();
		// 			$("#retorno").append(mensagem("Não foi possível registrar o agendamento!<br>"+retorno, "danger"));
		// 			window.setTimeout(function(){
		// 				location.reload();
		// 			}, 10000);
		// 		}
		// 	}
		// );
		$("#retorno").append(mensagem("Cadastrado com sucesso!", "success"));
	}

}

function mensagem($msg, $type){
	var $mensagem = '<div class="row-12 text-center"><div class="alert alert-'+$type+'" role="alert">'+$msg+'</div></div>';
	return $mensagem;
}

$(document).ready(function(){
	
});