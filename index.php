<?php
	session_start();

	if(isset($_SESSION['autenticado'])){
		include(__DIR__."/controller/functions.php");
		$userNameFull = $_SESSION['nomeCompleto'];
		$userType = $_SESSION['tipo_usuario'];
		$userId = $_SESSION['id_usuario'];
		$id_instituicao = $_SESSION['id_instituicao'];

		require_once(__DIR__."/bd/conexao.php");
		try {
			$consulta_1 = "SELECT * FROM instituicao WHERE id_instituicao = {$id_instituicao}";
			$instituicao = $conn->query($consulta_1)->fetch();

			$nome_instituicao = $instituicao['nome_instituicao'];
			$informacoes = $userNameFull." - ".$nome_instituicao;

		} catch (Exception $e) {
			echo "Erro ao buscar os dados da instituição!<br>Detalhes: ".$e->getMessage();
		}

		$menu = '
		<li class="nav-item active">
			<a class="nav-link" href="?page=home">Minha Página</a>
		</li>';

		$menu .= ($userType == 1 ?
		'<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="idTools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gerenciar</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="?page=instituicoes">Instituição</a>
				<a class="dropdown-item" href="?page=usuarios">Usuário</a>
			</div>
		</li>': '');

		$menu .= '
		<li class="nav-item navbar-toggler-right">
			<a class="nav-link" data-toggle="modal" data-target="#modalSair" href="">Sair</a>
		</li>
		';

		if(isset($_POST['sair'])){
			$menu  = '';
			unset($_SESSION['autenticado']);
			session_destroy();
			header("Location: /");
		}


	}else{
		session_destroy();
		$menu ='';
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<title>Get Device - Agendamento</title>

</head>
	<body">

	<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">

		<a class="navbar-brand" href="">Get Device</a>

		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#SuporteMenu" aria-controls="SuporteMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="SuporteMenu">
			<ul class="navbar-nav mr-auto">
				<?=$menu?>
			</ul>

		</div>

	</nav>

	<div id="modalSair" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmação</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Deseja realmente sair do sistema?</p>
				</div>
				<div class="modal-footer">
					<form action="" method="post">
						<button type="submit" name="sair" class="btn btn-primary">Sim</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
					</form>
				</div>
				</div>
		</div>
	</div>

    <div id="modalConfirma" class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                </div>
                <div class="modal-body">
                    <p>Tem certeza?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSimConfirmacao" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCarregando" class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-body">
                <img src="images/loading2.gif" alt="Carregando" width="100%">
            </div>
        </div>
    </div>


	<div class="container">
	<div id="retorno" class="mt-3"></div>

	<?php
	if(isset($_SESSION['autenticado'])){
		if(isset($_GET['page'])){
			$page = filter_input(INPUT_GET, 'page');

			switch ($page) {
				case 'home':
					include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
				break;
				case 'email-ativado':
					include($_SERVER['DOCUMENT_ROOT'].'/pages/email-ativado.php');
				break;
				case 'cadastrar-usuario':
					if($userType == 1){
						include($_SERVER['DOCUMENT_ROOT'].'/pages/novo-usuario.php');
					}else{
						include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
					}
				break;
				case 'usuarios':
					if($userType == 1){
						include($_SERVER['DOCUMENT_ROOT'].'/pages/usuarios.php');
					}else{
						include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
					}
				break;
				case 'nova-instituicao':
					if($userType == 1){
						include($_SERVER['DOCUMENT_ROOT'].'/pages/nova-instituicao.php');
					}else{
						include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
					}
				break;
				case 'instituicoes':
					if($userType == 1){
						include($_SERVER['DOCUMENT_ROOT'].'/pages/instituicoes.php');
					}else{
						include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
					}
				break;
				case 'agendamentos':
					include($_SERVER['DOCUMENT_ROOT'].'/pages/agendamentos.php');
				break;
				default:
					include($_SERVER['DOCUMENT_ROOT'].'/controller/home.php');
				break;
			}
		}else{
			include(__DIR__.'/controller/home.php');
		}
	}else{
		include(__DIR__.'/controller/login.php');
	}

?>
	</div>


	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/functions.js"></script>
	</body>
</html>