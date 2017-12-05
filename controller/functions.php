<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;


require $_SERVER['DOCUMENT_ROOT'].'\vendor\autoload.php';

function mensagem($msg, $type, $size = 'md'){
	$mensagem = '
		<div class="row-12 text-center">
			<div class="alert alert-'.$type.'" role="alert">'.$msg.'</div>
		</div>';

	return $mensagem;
}

function emailNovoAgendamentoAdmin($conn, $qnt, $data, $horaInicial, $horaFinal, $userId){
	date_default_timezone_set('America/Sao_Paulo');

  $dataAgendada = date('d/m/Y', strtotime($data));

	$dadosUser = $conn->query("SELECT * FROM usuario u INNER JOIN instituicao i ON u.instituicao_id_instituicao = i.id_instituicao WHERE id_usuario = {$userId}")->fetch();

	$nome_usuario = $dadosUser['nome_usuario']." ".$dadosUser['sobrenome_usuario'];
	$email_usuario = $dadosUser['email_usuario'];
	$id_instituicao = $dadosUser['id_instituicao'];
	$nome_instituicao = $dadosUser['nome_instituicao'];

	$assunto = 'Novo Agendamento - '.$nome_instituicao;

	$dataAtual = date('d/m/Y', time());
	$horaAtual = date('H:i', time());

	$mensagem = "<b><h3>".$assunto."</h3></b>";

	$mensagem .= "<br>Solicitante: ".$nome_usuario;
	$mensagem .= "<br><p>Um novo agendamento foi registrado no sistema. <br>Fique atento ao horário solicitado.</p>";
	$mensagem .= "<br>Detalhes:";
	$mensagem .= "<br>".$qnt." dispositivos";
	$mensagem .= "<br>Data Agendada: ".$dataAgendada;
	$mensagem .= "<br>Período: ".$horaInicial." a ".$horaFinal;
	$mensagem .= "<br><br><small>Agendamento realizado em ".$dataAtual.", às ".$horaAtual."hs</small>";

	//echo $mensagem;

/*------------CONFIGURACOES PARA ENVIAR O E-MAIL-----------------------------*/


	try {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
        $mail->SMTPDebug = 0;

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Set AuthType to use XOAUTH2
        $mail->AuthType = 'XOAUTH2';

//Fill in authentication details here
//Either the gmail account owner, or the user that gave consent
        $email = 'contato.getdevice@gmail.com';
        $clientId = '806470247310-2o8d1c3u0pd1buq6ngno7ni07c3qgi4m.apps.googleusercontent.com';
        $clientSecret = 'KFdMUbK9Xeqbm6OYhi3rAJwM';

//Obtained by configuring and running get_oauth_token.php
//after setting up an app in Google Developer Console.
        $refreshToken = '1/mch9gDWKttGutzvmfGGJVWhcQIAOmPLydujTQAwRn9DyFNLmlsNOzWryTxDmW5Oy';

//Create a new OAuth2 provider instance
        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );

//Pass the OAuth provider instance to PHPMailer
        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

		$mail->Debugoutput = 'html';
		$mail->CharSet = 'utf-8';
		$mail->WordWrap = 80;
		$mail->setLanguage('br');

		//Recipients
		$mail->SetFrom($email, "Contato Get Device");
		$mail->AddReplyTo($email_usuario, $nome_usuario);

		$listAdmin = $conn->query("SELECT nome_usuario, email_usuario FROM usuario WHERE tipo_usuario = 1 AND instituicao_id_instituicao = {$id_instituicao}");

		foreach ($listAdmin as $dadosAdmin) {
			$mail->AddAddress($dadosAdmin['email_usuario'], $dadosAdmin['nome_usuario']);
		}

		//Content
		$mail->isHTML(true);
		$mail->Subject = $assunto;
		$mail->MsgHTML($mensagem);

    if($mail->Send()){
      return true;
    }

	}catch (Exception $e) {
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
      return false;
	}

}

function emailNovoAgendamentoUser($conn, $qnt, $data, $horaInicial, $horaFinal, $userId){
  date_default_timezone_set('America/Sao_Paulo');

  $dataAgendada = date('d/m/Y', strtotime($data));

  $dadosUser = $conn->query("SELECT * FROM usuario u INNER JOIN instituicao i ON u.instituicao_id_instituicao = i.id_instituicao WHERE id_usuario = {$userId}")->fetch();

  $nome_usuario = $dadosUser['nome_usuario']." ".$dadosUser['sobrenome_usuario'];
  $email_usuario = $dadosUser['email_usuario'];
  $id_instituicao = $dadosUser['id_instituicao'];
  $nome_instituicao = $dadosUser['nome_instituicao'];

  $assunto = 'Novo Agendamento - '.$nome_instituicao;

  $dataAtual = date('d/m/Y', time());
  $horaAtual = date('H:i', time());

  $mensagem = "<b><h3>".$assunto."</h3></b>";

  $mensagem .= "<br>Olá ".$nome_usuario;
  $mensagem .= "<br><p>Registramos o seu agendamento de horário para usar nossos dispositivos.</p>";
  $mensagem .= "<br>Detalhes:";
  $mensagem .= "<br>".$qnt." dispositivos";
  $mensagem .= "<br>Data Agendada: ".$dataAgendada;
  $mensagem .= "<br>Período: ".$horaInicial." a ".$horaFinal;
  $mensagem .= "<br><br><small>Operação realizada em ".$dataAtual.", às ".$horaAtual."hs</small>";
  $mensagem .= "<br><small>Em caso de dúvidas, entre em contato com o setor de T.I através do endereço <i>contato.getdevice@gmail.com</small>";

  //echo $mensagem;

/*------------CONFIGURACOES PARA ENVIAR O E-MAIL-----------------------------*/


  try {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
        $mail->SMTPDebug = 0;

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Set AuthType to use XOAUTH2
        $mail->AuthType = 'XOAUTH2';

//Fill in authentication details here
//Either the gmail account owner, or the user that gave consent
        $email = 'contato.getdevice@gmail.com';
        $clientId = '806470247310-2o8d1c3u0pd1buq6ngno7ni07c3qgi4m.apps.googleusercontent.com';
        $clientSecret = 'KFdMUbK9Xeqbm6OYhi3rAJwM';

//Obtained by configuring and running get_oauth_token.php
//after setting up an app in Google Developer Console.
        $refreshToken = '1/mch9gDWKttGutzvmfGGJVWhcQIAOmPLydujTQAwRn9DyFNLmlsNOzWryTxDmW5Oy';

//Create a new OAuth2 provider instance
        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );

//Pass the OAuth provider instance to PHPMailer
        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

    $mail->Debugoutput = 'html';
    $mail->CharSet = 'utf-8';
    $mail->WordWrap = 80;
    $mail->setLanguage('br');

    //Recipients
    $mail->SetFrom($email, "Contato Get Device");
    $mail->AddReplyTo($email_usuario, $nome_usuario);
    $mail->AddAddress($email_usuario, $nome_usuario);


    //Content
    $mail->isHTML(true);
    $mail->Subject = $assunto;
    $mail->MsgHTML($mensagem);

    if($mail->Send()){
      return true;
    }

  }catch (Exception $e) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      return false;
  }

}



function emailLinkAtivacao($conn, $code, $email_usuario, $nome_usuario){
  date_default_timezone_set('America/Sao_Paulo');

  $assunto = 'Novo Usuário Cadastrado';

  $link = '<a href="http://losites.com.br/gd/confirmando-email.php?code='.$code.'&v">aqui</a>';

  $dataAtual = date('d/m/Y', time());
  $horaAtual = date('H:i', time());

  $mensagem = "<b><h3>".$assunto."</h3></b>";

  $mensagem .= "<br>Olá ".$nome_usuario.", seja bem vindo ao Get Device!";
  $mensagem .= "<br><p>Você foi cadastrado e agora pode fazer agendamentos de qualquer lugar!</p>";
  $mensagem .= "<br><p>Para poder acessar o sistema, você precisa confirmar seu e-mail clicando ".$link."</p>";
  $mensagem .= "<br><br><small>Operação realizada em ".$dataAtual.", às ".$horaAtual."hs</small>";
  $mensagem .= "<br><small>Em caso de dúvidas, entre em contato com o setor de T.I através do endereço <i>contato.getdevice@gmail.com</small>";

  //echo $mensagem;

/*------------CONFIGURACOES PARA ENVIAR O E-MAIL-----------------------------*/


  try {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

//Tell PHPMailer to use SMTP
        $mail->isSMTP();

//Enable SMTP debugging
        $mail->SMTPDebug = 0;

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Set AuthType to use XOAUTH2
        $mail->AuthType = 'XOAUTH2';

//Fill in authentication details here
//Either the gmail account owner, or the user that gave consent
        $email = 'contato.getdevice@gmail.com';
        $clientId = '806470247310-2o8d1c3u0pd1buq6ngno7ni07c3qgi4m.apps.googleusercontent.com';
        $clientSecret = 'KFdMUbK9Xeqbm6OYhi3rAJwM';

//Obtained by configuring and running get_oauth_token.php
//after setting up an app in Google Developer Console.
        $refreshToken = '1/mch9gDWKttGutzvmfGGJVWhcQIAOmPLydujTQAwRn9DyFNLmlsNOzWryTxDmW5Oy';

//Create a new OAuth2 provider instance
        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );

//Pass the OAuth provider instance to PHPMailer
        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

    $mail->Debugoutput = 'html';
    $mail->CharSet = 'utf-8';
    $mail->WordWrap = 80;
    $mail->setLanguage('br');

    //Recipients
    $mail->SetFrom($email, "Contato Get Device");
    $mail->AddReplyTo($email_usuario, $nome_usuario);
    $mail->AddAddress($email_usuario, $nome_usuario);


    //Content
    $mail->isHTML(true);
    $mail->Subject = $assunto;
    $mail->MsgHTML($mensagem);

    if($mail->Send()){
      return true;
    }

  }catch (Exception $e) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      return false;
  }

}
?>