<?php
require_once("phpmail/class.phpmailer.php");

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->Host 			= 'smtp.gmail.com'; 
$mail->SMTPAuth   		= true;  
$mail->SMTPKeepAlive 	= true;  
$mail->SMTPSecure 		= 'ssl'; 
//$mail->SMTPDebug 		= 1;
$mail->SMTPDebug 		= true;
$mail->Port       		= 587; 
$mail->SMTPSecure 		= true;
$mail->Username 		= 'augustomoreno674@gmail.com'; 
$mail->Password 		= 'augusto!@#'; 

$mail->SetFrom('augustomoreno674@gmail.com', 'augustomoreno674@gmail.com'); 
$mail->AddReplyTo('augustomoreno674@gmail.com', 'augustomoreno674@gmail.com'); 
$mail->Subject = 'REC: Assunto';

$mail->AddAddress('erickqueiroz@gmail.com', 'erickqueiroz@gmail.com');
$mail->MsgHTML('<html><body>Teste</body></html>'); 
$mail->AltBody = 'This is a plain-text message body';
$mail->Send();
if (!$mail->send()) {
	echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
	echo 'Message sent!';
}

/*try {
	
}catch (phpmailerException $e) {
	echo $e;
}*/