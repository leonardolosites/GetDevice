<?php

	if(isset($_POST['cadastrar'])){
		require_once("../bd/conexao.php");
		require_once("functions.php");

		$nome = $_POST['nome'];
		$endereco = $_POST['endereco'];
		$dispositivos = $_POST['dispositivos'];

		$dados = array (
			':nome' => $nome,
			':endereco' => $endereco,
			':dispositivos' => $dispositivos,
			':dispositivos_disp' => $dispositivos
		);

 		$sqlInsereInst = "INSERT INTO instituicao (nome_instituicao, endereco_instituicao, dispositivos_instituicao, dispositivos_disponiveis_instituicao) VALUES (:nome, :endereco, :dispositivos, :dispositivos_disp)";


		try {
			$insere = $conn->prepare($sqlInsereInst);
			$in = $insere->execute($dados);
			echo 'ok';

		} catch (Exception $e) {
			$msg = "Erro:insere-nova-instituicao.php::".$e->getMessage();
			echo $msg;
		}

	}else{
		header("Location: /");
	}
?>