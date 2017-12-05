<?php

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$id_instituicao = $_POST['id_instituicao'];

	$sqlDeleteAgd = "DELETE FROM agendamento WHERE id_agendamento = {$id}";

	try {
		require_once("../bd/conexao.php");
		$conn->query("UPDATE instituicao SET dispositivos_disponiveis_instituicao = (dispositivos_disponiveis_instituicao + (SELECT quantidade_de_dispositivos_agendamento FROM agendamento WHERE id_agendamento = {$id})) WHERE id_instituicao = {$id_instituicao}");
		$conn->query($sqlDeleteAgd);
		echo 'ok';

	} catch (Exception $e) {
		echo $e->getMessage();
	}
}else{
	header("Location: /");
}

?>