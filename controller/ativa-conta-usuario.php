<?php

if(isset($_POST['id_usuario'])){
	$id_usuario = $_POST['id_usuario'];
	$id_inst = $_POST['id_instituicao'];
	$acao = $_POST['acao'];


	try {
		require_once("../bd/conexao.php");

		$conn->query("UPDATE usuario SET status_usuario = {$acao}, hash_code_usuario = NULL WHERE id_usuario = {$id_usuario} AND instituicao_id_instituicao = {$id_inst}");
		echo "ok";

	} catch (Exception $e) {
		echo $e->getMessage();
	}

}else{
	header("Location: /");
}
?>