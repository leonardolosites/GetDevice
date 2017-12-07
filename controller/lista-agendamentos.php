<?php
	date_default_timezone_set('America/Sao_Paulo');

	$dataAtual = date('Y-m-d');
	$horaAtual = date('H:i:s');


	$sqlAtualizaLista = "SELECT id_agendamento, quantidade_de_dispositivos_agendamento FROM agendamento WHERE instituicao_id_instituicao = {$id_instituicao} AND( ( data_agendamento = '{$dataAtual}' AND horario_final_agendamento < '{$horaAtual}' ) OR (data_agendamento < '{$dataAtual}') ) ORDER BY data_agendamento ASC";

	$upList = $conn->query($sqlAtualizaLista);

	try {
		foreach ($upList as $ul) {
			$conn->query("UPDATE instituicao SET dispositivos_disponiveis_instituicao = (dispositivos_disponiveis_instituicao + {$ul['quantidade_de_dispositivos_agendamento']}) WHERE id_instituicao = {$id_instituicao}");
			$conn->query("DELETE FROM agendamento WHERE id_agendamento = {$ul['id_agendamento']}");
		}
	} catch (Exception $eUp) {
		echo $eUp->getMessage();
	}


	$filter = " a.instituicao_id_instituicao = {$id_instituicao} AND ((data_agendamento >= '{$dataAtual}' AND horario_final_agendamento > '{$horaAtual}') OR (data_agendamento > '{$dataAtual}')) ";

	if($userType == 1){
		$sqlListaAgd = "SELECT * FROM agendamento a INNER JOIN usuario u ON a.usuario_id_usuario = u.id_usuario WHERE {$filter} ORDER BY data_agendamento DESC";
	}else{
		$sqlListaAgd = "SELECT * FROM agendamento a INNER JOIN usuario u ON a.usuario_id_usuario = u.id_usuario WHERE usuario_id_usuario = {$userId} AND {$filter} ORDER BY data_agendamento ASC";
	}

	try {

		require_once("/bd/conexao.php");

		$agendamentos = $conn->query($sqlListaAgd);

		$lista = '';

		if($agendamentos->rowCount() > 0){
			foreach ($agendamentos as $agd) {
				$status = ((($agd['horario_inicial_agendamento'] <= $horaAtual) AND ($agd['data_agendamento'] == $dataAtual)) ? 'table-danger text-danger' : '');
				$lista .= "
					<tr class='{$status}'>
						<td>".$agd['nome_usuario']." ".$agd['sobrenome_usuario']."</td>
						<td>{$agd['quantidade_de_dispositivos_agendamento']}</td>
						<td>".date('d/m/Y', strtotime($agd['data_agendamento']))."</td>
						<td>".date('H:i', strtotime($agd['horario_inicial_agendamento']))."</td>
						<td>".date('H:i', strtotime($agd['horario_final_agendamento']))."</td>
						<td><button type='button' onclick='cancelaAgd({$agd['id_agendamento']}, {$id_instituicao}, {$userId})' class='btn btn-sm btn-danger w-100'>Cancelar</button></td>
					</tr>
				";
			}
		}else{
			$msgVazio = 'Nenhum agendamento pendente!';
			echo "<tr><td class='text-center' colspan='6'>".$msgVazio."</td></tr>";
		}

		echo $lista;

	} catch (Exception $e) {
		$msgError = "<tr class='table-danger text-danger'><td class='text-center' colspan='6'>Erro ao listar os agendamentos! <br>Detalhes: ".$e->getMessage()."</td></tr>";
		echo $msgError;
	}
?>