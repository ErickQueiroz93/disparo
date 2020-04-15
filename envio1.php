<?php
require_once("../phpmail/class.phpmailer.php");

$mail = new PHPMailer(true);

$mail->IsSMTP(); 


try {
	$mail->Host = 'smtp.gmail.com'; 
	$mail->SMTPAuth   = true;  
	$mail->SMTPKeepAlive = true;  
	$mail->SMTPSecure = 'ssl'; 
	$mail->SMTPDebug = 1;
	$mail->Port       = 587; 
	$mail->Username = 'augustomoreno674@gmail.com'; 
	$mail->Password = 'augusto!@#'; 

	$mail->SetFrom('recadastramento@bb.com.br', 'BB'); 
	$mail->AddReplyTo('recadastramento@bb.com.br', 'BB'); 
	$mail->Subject = 'REC: Assunto';

	$mail->AddAddress('erickqueiroz@gmail.com', 'erickqueiroz@gmail.com');
	$mail->MsgHTML($mensagemHTML); 
	$mail->Send();
	
}catch (phpmailerException $e) {
	echo $e;
}