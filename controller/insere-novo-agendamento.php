<?php

	if(isset($_POST['agendar'])){
		require_once("../bd/conexao.php");
		require_once("functions.php");

		$qnt = $_POST['qnt'];
		$data = $_POST['data'];
		$horaInicio = $_POST['horaInicio'];
		$horaFim = $_POST['horaFim'];
		$userId = $_POST['idUser'];
		$id_instituicao = $_POST['idInst'];

		$dados = array (
			':qnt' => $qnt,
			':data' => $data,
			':hora_inicio' => $horaInicio,
			':hora_fim' => $horaFim,
			':usuario' => $userId,
			':instituicao' => $id_instituicao
		);


		$sqlUpdateInst = "UPDATE instituicao SET dispositivos_disponiveis_instituicao = (dispositivos_disponiveis_instituicao - {$qnt}) WHERE id_instituicao = {$id_instituicao}";

		$sqlInsereAgd = "INSERT INTO agendamento (quantidade_de_dispositivos_agendamento, data_agendamento, horario_inicial_agendamento, horario_final_agendamento, usuario_id_usuario, instituicao_id_instituicao) VALUES (:qnt, :data, :hora_inicio, :hora_fim, :usuario, :instituicao)";


		try {
			$up = $conn->query($sqlUpdateInst);

			if($up){
				$insere = $conn->prepare($sqlInsereAgd);
				$in = $insere->execute($dados);
				if($in){
					emailNovoAgendamentoAdmin($conn, $qnt, $data, $horaInicio, $horaFim, $userId);
					emailNovoAgendamentoUser($conn, $qnt, $data, $horaInicio, $horaFim, $userId);
					echo 'ok';
				}
			}else{
				$conn->query("UPDATE instituicao SET dispositivos_disponiveis_instituicao = (dispositivos_disponiveis_instituicao + {$qnt}) WHERE id_instituicao = {$id_instituicao}");
			}

		} catch (Exception $e) {
			$msg = "Erro:insere-novo-agendamento.php::".$e->getMessage();
			echo $msg;
		}

	}else{
		header("Location: /");
	}
?>