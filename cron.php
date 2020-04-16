<?php
require_once("phpmail/class.phpmailer.php");
include("config.php");

//BUSCA PRIMEIRA CAMPANHA ATIVA
	
$sql = "SELECT * FROM campanha WHERE ativada = 1 ORDER BY id_campanha ASC LIMIT 1";
$result = $PDO->query( $sql );
$rows = $result->fetch();

//BUSCA EMAIL PARA DISPARO
$sqlEmail = "SELECT * FROM smtp WHERE enviado < 2000 AND date < '".date('Y-m-d')."' ORDER BY id_smtp ASC LIMIT 1";
$resultEmail = $PDO->query( $sqlEmail );
$rowsEmail = $resultEmail->fetch();

//BUSCA LISTA EMAIL
$sqlLista = "SELECT * FROM email WHERE enviado = 0 AND id_campanha = '".$rows['id_campanha']."' ORDER BY id_email ASC LIMIT 4";
$resultLista = $PDO->query( $sqlLista );
$rowsLista = $resultLista->fetchAll(PDO::FETCH_ASSOC);

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->Host 			= 'smtp.gmail.com'; 
$mail->SMTPAuth   		= true;  
$mail->SMTPKeepAlive 	= true;  
$mail->SMTPSecure 		= 'tls'; 
$mail->SMTPDebug 		= false;
$mail->SingleTo 		= true;
$mail->Port       		= 587; 
$mail->Username 		= $rowsEmail['email']; 
$mail->Password 		= $rowsEmail['senha']; 

$mail->SetFrom($rows['remetente'], $rows['nome']); 
$mail->AddReplyTo($rows['remetente'], $rows['nome']); 
$mail->Subject = $rows['assunto'];

$data = date('Y-m-d');
$enviado = 1;
$quebra = chr(13).chr(10);
$log = "";
$contaEnvios = 0; 

$mail->MsgHTML(html_entity_decode($rows['html'])); 
$mail->AltBody = 'This is a plain-text message body';
 
foreach($rowsLista as $i => $v)
{
	$mail->AddAddress($v['email']);
	if(!$mail->send()) 
	{
		$log .= str_replace("\r"," ", $v['email'])."Nao enviado".$quebra;
	} 
	else 
	{
		$log .= str_replace("\r"," ", $v['email'])."Enviado com sucesso".$quebra;
	}
	$sql = "UPDATE email SET data_envio = ?, enviado = ? WHERE id_email = ?";
	$PDO->prepare($sql)->execute([$data, $enviado, $v['id_email']]);
	
	
	$contaEnvios++;
}

$novaQuantidadeEnviada = $contaEnvios + $rowsEmail['enviado'];


//ATUALIZA LIMITE DE EMAIL DISPARO
$amanha = $rowsEmail['date'];
if($novaQuantidadeEnviada >= 2000)
{
	$amanha = date('Y-m-d', strtotime('+1 days', strtotime(date('Y-m-d'))));
}

$sql = "UPDATE smtp SET date = ?, enviado = ? WHERE id_smtp = ?";
$PDO->prepare($sql)->execute([$amanha, $novaQuantidadeEnviada, $rowsEmail['id_smtp']]);

$fp = fopen("log/campanha_log_".$rows['id_campanha'].".txt", "a");
$escreve = fwrite($fp, $log);
fclose($fp);

$quantidadeParaSerEnviada = $rows['qtde_email'];

$sqlContaEnviados = "SELECT SUM(enviado) AS qtde FROM email WHERE enviado = 1 AND id_campanha = '".$rows['id_campanha']."' GROUP BY enviado";
$resultContaEnviados = $PDO->query( $sqlContaEnviados );
$rowsContaEnviados = $resultContaEnviados->fetch();

if($rowsContaEnviados['qtde'] >= $quantidadeParaSerEnviada)
{
	$finalizada = 1;
	$sql = "UPDATE campanha SET ativada = ?, qtde_enviada = ? WHERE id_campanha = ?";
	$PDO->prepare($sql)->execute([$finalizada, $rowsContaEnviados['qtde'], $rows['id_campanha']]);
}