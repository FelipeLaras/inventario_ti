<?php
	require_once('../bd/conexao.php');

	//Recebendo as Variais
	$nome = $_POST['primeiroNome'];
	$mail = $_POST['email'];
	$senha = $_POST['senha'];
	$motivo = $_POST['mensagem'];
	$perfil = $_POST['perfil'];

	#INICIO VALIDAÇÂO SE EXISTE O USUÁRIO	
	//Montando a query de validação
	$query_valid = "SELECT profile_mail AS mail FROM manager_profile WHERE profile_mail = '".$mail."'";

	//Aplicando a query
	$result_valid = $conn -> query($query_valid);
	//Recebendo o resultado
	$rom_valid = $result_valid -> fetch_assoc();
	//montando a regra de validação
	if ($rom_valid['mail'] != NULL) {
		header('location: ../front/forgot-password.php?msn=2');
		exit;
	}
	#FIM

	#ENVIO DE EMAIL
	require_once('../PHPMailer/PHPMailerAutoload.php');
	
	//variaveis de conf. envio
	$smtp = "smtp.gmail.com";//servidor usado para envio
	$porta = "465"; //porta padrão SSL
	$login_email = "apoio.sistemas@gruposervopa.com.br"; //usuario para o login do SMTP
	$senha_email = "tiservopa123"; //senha para o login ao SMTP
	$destinatario = "felipe.lara@servopa.com.br";//O mail que receberá as msn
	$titulo_email = "Solicitacao de Acesso";

	//Criando o corpo da mensagem.

	$corpo = '<head>
				<style type="text/css">
					#tabela{width: 70%}
					h1 {margin-left: 27%;}
					th{padding: 2px 7px 1px 7px;}
				</style>
			</head>';
	$corpo .= '<div id="tabela">
				<h1>Solicitação de Cadastro - Inventario TI</h1>';
	$corpo .='<table border="1">
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Perfil</th>
					<th>Senha</th>
					<th>Motivo</th>
				</tr>
				<tr>
					<th>'.$nome.'</th>
					<th>'.$mail.'</th>
					<th>'.$perfil.'</th>
					<th>'.$senha.'</th>
					<th>'.$motivo.'</th>
				</tr>
			</table></div>';

	#Configurando o e-mail

	//Definando o PHPMailer
	$Mailer = new PHPMailer();
	
	//Define que será usado SMTP
	$Mailer->IsSMTP();
	
	//Enviar e-mail em HTML
	$Mailer->isHTML(true);
	
	//Aceitar carasteres especiais
	$Mailer->Charset = 'UTF-8';
	
	//Configurações
	$Mailer->SMTPAuth = true;
	$Mailer->SMTPSecure = 'ssl';
	
	//nome do servidor
	$Mailer->Host = $smtp;
	//Porta de saida de e-mail 
	$Mailer->Port = $porta;
	

	#Montando o e-mail

	//Dados do e-mail de saida - autenticação
	$Mailer->Username = $login_email;
	$Mailer->Password = $senha_email;
	
	//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
	$Mailer->From = $login_email;
	
	//Nome do Remetente
	$Mailer->FromName = $nome;
	
	//Assunto da mensagem
	$Mailer->Subject = $titulo_email;
	
	//Corpo da Mensagem
	$Mailer->Body = $corpo;
	
	//Corpo da mensagem em texto
	$Mailer->AltBody = '';
	
	//Destinatario 
	$Mailer->AddAddress($destinatario);
	
	if($Mailer->Send()){
		header('location: ../index.php?msn=1');
	}else{
		echo "Erro no envio do e-mail: " . $Mailer->ErrorInfo;
	}
//fechando a conexão com o banco
$conn -> close();
