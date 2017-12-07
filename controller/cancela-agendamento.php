<?php

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$id_instituicao = $_POST['id_instituicao'];
	$userId = $_POST['idUser'];
	
	$sqlDeleteAgd = "DELETE FROM agendamento WHERE id_agendamento = {$id}";

	try {
		require_once("../bd/conexao.php");
		require_once("functions.php");
		$conn->query("UPDATE instituicao SET dispositivos_disponiveis_instituicao = (dispositivos_disponiveis_instituicao + (SELECT quantidade_de_dispositivos_agendamento FROM agendamento WHERE id_agendamento = {$id})) WHERE id_instituicao = {$id_instituicao}");
		$y = $conn->query($sqlDeleteAgd);
		if($y){
			emailCancelaAgd($conn, $id, $userId);
			echo 'ok';
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}
}else{
	header("Location: /");
}

?>