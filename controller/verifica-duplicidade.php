<?php
require_once("../bd/conexao.php");
$tabela = $_POST['tabela'];

switch ($tabela) {
	case 'usuario':
		$email = $_POST['email'];
		$usuario = $_POST['usuario'];

		try {
			$cont = $conn->query("SELECT * FROM usuario WHERE email_usuario = '{$email}' OR usuario_usuario = '{$usuario}'")->rowCount();

			if($cont == 1){
				echo 'sim';
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	break;
}
?>