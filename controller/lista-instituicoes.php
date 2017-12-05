<?php
	date_default_timezone_set('America/Sao_Paulo');

	$sqlListaInst = "SELECT * FROM instituicao WHERE id_instituicao != {$id_instituicao} ORDER BY nome_instituicao ASC";

	try {

		require_once("/bd/conexao.php");

		$instituicoes = $conn->query($sqlListaInst);

		$lista = '';

		foreach ($instituicoes as $inst) {
		$lista .= "
			<tr>
				<td>{$inst['id_instituicao']}</td>
				<td>{$inst['nome_instituicao']}</td>
				<td>{$inst['endereco_instituicao']}</td>
				<td>{$inst['dispositivos_instituicao']}</td>
			</tr>";
		}

		if($instituicoes->rowCount() > 0){
			echo $lista;
		}else{
			echo "<tr><td class='text-center' colspan='4'>Nenhuma instituição cadastrada!</td></tr>";
		}

	} catch (Exception $e) {
		$msgError = "<tr class='table-danger text-danger'><td class='text-center' colspan='8'>Erro ao listar as instituições! <br>Detalhes: ".$e->getMessage()."</td></tr>";
		echo $msgError;
	}
?>