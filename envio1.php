<?php
require_once("phpmail/class.phpmailer.php");

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->Host 			= 'smtp.gmail.com'; 
$mail->SMTPAuth   		= true;  
$mail->SMTPKeepAlive 	= true;  
$mail->SMTPSecure 		= 'tls'; 
$mail->SMTPDebug 		= false;
$mail->SingleTo 		= true;
$mail->Port       		= 587; 
$mail->Username 		= 'augustomoreno674@gmail.com'; 
$mail->Password 		= 'augusto!@#'; 

$mail->SetFrom('bb@46bb.com.br', 'Banco do Brasil46'); 
$mail->AddReplyTo('bb@46bb.com.br', 'Banco do Brasil46'); 
$mail->Subject = 'REC: Assunto ssss';

$mail->AddAddress('Ciganobank9@gmail.com');
$mail->AddAddress('Caixagov85@gmail.com');
$mail->AddAddress('Filhothiago1811@gmail.com');
$mail->AddAddress('erickqueiroz93@gmail.com');

$mail->MsgHTML('<html><body>Tesssssswqwqwqste</body></html>'); 
$mail->AltBody = 'This is a plain-text message body';

if (!$mail->send()) {
	echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
	echo 'Message sent!';
}