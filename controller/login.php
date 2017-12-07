<?php

include_once 'bd/conexao.php';
include_once 'controller/functions.php';

if(isset($_POST['acao']) && $_POST['acao'] == "Entrar"){

	$usuario = filter_input(INPUT_POST, 'usuario');
	$senha = filter_input(INPUT_POST, 'senha');
	$senha = sha1(base64_encode($senha."@".$usuario));

	$dados = array(

		':usuario' => $usuario,
		':senha' => $senha

	);

	$query = ("SELECT * FROM usuario WHERE usuario_usuario = :usuario AND senha_usuario = :senha");

	$result = $conn->prepare($query);
	$result->execute($dados);

		if($result->rowCount() > 0 ){
			session_start();
			$key = $result->fetch();

			$userStatus = $key['status_usuario'];
			if($userStatus == 0){
				echo '<br>'.mensagem("<h4>Sua conta ainda não foi ativada</h4>Acesse a caixa de entrada do e-mail fornecido para cadastro e verifique se existe um e-mail<br>com o título <b>Novo Usuário Cadastrado</b>, do remetente <i>contato.getdevice@gmail.com</i> e siga as instruções. <br><br><small>Caso não encontre o e-mail, procure o setor de T.I da sua instituição.</small>", "info");
			}else{
				$userType = $key['tipo_usuario'];
				$userId = $key['id_usuario'];
				$instId = $key['instituicao_id_instituicao'];
				$userNameFull = $key['nome_usuario']." ".$key['sobrenome_usuario'];

				$_SESSION['autenticado'] = true;
				$_SESSION['id_usuario'] = $userId;
				$_SESSION['tipo_usuario'] = $userType;
				$_SESSION['id_instituicao'] = $instId;
				$_SESSION['nomeCompleto'] = $userNameFull;

				header("Location: /");
			}

		}else{

			echo '<br>'.mensagem("Nenhum registro com esses dados foi encontrado no sistema.", "danger");

		}
	}

?>
<form method="post" action="" name="formLogin">
	<div class="d-flex flex-column">
		<label class="col text-center my-4">
		<h5>Fazer Login no Sistema</h5>
		</label>

		<div class="row my-2">
			<div class="input-group col">
				<input autofocus class="form-control col-12" type="text" placeholder="Usuário" required name="usuario" id="idUsuario">
			</div>
		</div>

		<div class="row my-2">
			<div class="input-group col">
				<input class="form-control col-12" required placeholder="Senha" type="password" name="senha" id="idSenha">
			</div>
		</div>

		<div class="row my-2">
			<div class="col">
				<input type="submit" class="btn btn-primary col" name="acao" value="Entrar">
			</div>
		</div>

		<div class="row">
			<div class="link col-12 text-center"> 
				<a href="" class="btn btn-link text-info" data-toggle="modal" data-target="#modalSolicitaRedefinirSenha">Redefinir minha senha</a>
			</div>
		</div>
	</div>
</form>

<div id="modalSolicitaRedefinirSenha" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<form method="post" action="solicita-redefinir-senha.php">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Solicitar Redefinição de Senha</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="emailRedefinirSenha">Informe seu e-mail</label>
						<input type="email" required class="form-control col-12" id="emailRedefinirSenha">
					</div>
				</div>
				<div class="modal-footer">
					<form action="" method="post">
						<button type="submit" class="btn btn-primary">Enviar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</form>
				</div>
			</div>
		</form>
	</div>
</div>