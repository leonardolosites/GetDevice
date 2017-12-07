<?php
	date_default_timezone_set('America/Sao_Paulo');

	$sqlListaUsers = "SELECT * FROM usuario WHERE instituicao_id_instituicao = {$id_instituicao} AND id_usuario != {$userId} ORDER BY nome_usuario ASC, status_usuario DESC";

	try {

		require_once("/bd/conexao.php");

		$usuarios = $conn->query($sqlListaUsers);

		$lista = '';

		foreach ($usuarios as $user) {
			$status = ($user['status_usuario'] == 0 ? 'table-warning' : '');
			$lista .= "
				<tr class='{$status}'>
					<td>{$user['id_usuario']}</td>
					<td>{$user['nome_usuario']}</td>
					<td>{$user['sobrenome_usuario']}</td>
					<td>{$user['email_usuario']}</td>
					<td>".($user['tipo_usuario'] == 1 ? 'Admin' : 'User')."</td>
					<td>{$user['usuario_usuario']}</td>";
			if($user['status_usuario'] == 1){
				$lista .= "
					<td>Habilitado</td>
					<td><button type='button' onclick=\"statusUser({$user['id_usuario']}, {$id_instituicao}, 'disable');\" class='btn btn-sm btn-danger w-100'>Desabilitar</button></td>
					<td><button type='button' onclick=\"editUser({$user['id_usuario']}, {$id_instituicao});\" class='btn btn-sm btn-info w-100'>Editar</button></td>";
			}else{
				$lista .= "
					<td>Desabilitado</td>
					<td><button type='button' onclick=\"statusUser({$user['id_usuario']}, {$id_instituicao}, 'enable');\" class='btn btn-sm btn-success w-100'>Habilitar</button></td>
					<td><button type='button' onclick=\"editUser({$user['id_usuario']}, {$id_instituicao});\" class='btn btn-sm btn-info w-100'>Editar</button></td>";
			}

			$lista .= "</tr>";
		}
		if($usuarios->rowCount() > 0){
			echo $lista;
		}else{
			echo "<tr><td class='text-center' colspan='8'>Nenhum usuário cadastrado!</td></tr>";
		}

	} catch (Exception $e) {
		$msgError = "<tr class='table-danger text-danger'><td class='text-center' colspan='8'>Erro ao listar os usuários! <br>Detalhes: ".$e->getMessage()."</td></tr>";
		echo $msgError;
	}
?>