<?php

if(isset($_GET['code']) && !empty($_GET['code']) && isset($_GET['v'])){
	$hash_code_usuario = $_GET['code'];
	require_once("bd/conexao.php");

	try {

		$conn->query("UPDATE usuario SET status_usuario = 1, hash_code_usuario = NULL WHERE hash_code_usuario = '{$hash_code_usuario}'");
		header("Location: /?page=email-ativado");

	} catch (Exception $e) {
		echo $e->getMessage();
	}

}else{
	header("Location: /");
}
?>