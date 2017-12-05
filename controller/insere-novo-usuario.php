<?php

	if(isset($_POST['cadastrar'])){
		require_once("../bd/conexao.php");
		require_once("functions.php");

		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$tipo = $_POST['tipo'];
		$id_inst = $_POST['id_inst'];

		$dados = array (
			':nome' => $nome,
			':sobrenome' => $sobrenome,
			':email' => $email,
			':usuario' => $usuario,
			':senha' => sha1(base64_encode($senha."@".$usuario)),
			':tipo' => $tipo,
			':id_inst' => $id_inst
		);
 		$sqlInsereUser = "INSERT INTO usuario (nome_usuario, sobrenome_usuario, email_usuario, usuario_usuario, senha_usuario, tipo_usuario, instituicao_id_instituicao) VALUES (:nome, :sobrenome, :email, :usuario, :senha, :tipo, :id_inst)";


		try {

			$insere = $conn->prepare($sqlInsereUser);
			$in = $insere->execute($dados);
			echo 'ok';

		} catch (Exception $e) {
			$msg = "Erro:insere-novo-usuario.php::".$e->getMessage();
			echo $msg;
		}

	}else{
		header("Location: /");
	}
?>