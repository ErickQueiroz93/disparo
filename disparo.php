<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Disparos</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
  </head>

  <body class="text-center">
	
	<?php 
	
		if(isset($_POST['emails']))
		{
			
			
			$nome = $_POST['nome'];
			$remetente = $_POST['remetente'];
			$assunto = $_POST['assunto'];
			$tela = $_POST['tela'];
			$html = $_POST['html'];
			
			$mensagemHTML = '<html><body><a href="'.$tela.'">'.$html.'</a></body></html>';
			
			$text = trim($_POST['emails']);
			$textAr = explode("\n", $text);
			$textAr = array_filter($textAr, 'trim');
			
			$headers = "MIME-Version: 1.1\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "X-Mailer: Microsoft Office Outlook, Build 17.551210\r\n";
			$headers .= "From: ".$remetente." \r\n";
			$headers .= "Return-Path: ".$remetente." \r\n";
			
			$subj = $assunto;

			foreach ($textAr as $email) 
			{
				$envio = mail($email, $subj, $mensagemHTML, $headers);
				if($envio)
				{
					echo '<div class="alert alert-success" role="alert">E-mail para '.$email.' enviado com sucesso.</div>';
				}	
				else
				{
					echo '<div class="alert alert-danger" role="alert">E-mail para '.$email.' n&atilde;o foi enviado.</div>';
				}	
				
			} 
			
		}
		
	?>
	
  
    <form class="form-signin" action="disparo.php" method="POST" style="margin-top: -150px; max-width: 1000px;">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Envios</h1>
      </div>

		<div class="row">
			<div class="col-lg-6">
				<div class="form-label-group">
					<input type="text" id="nome" name="nome" class="form-control" placeholder="Banco do Brasil" required autofocus>
					<label for="nome">Nome(Ex:Banco do Brasil)</label>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-label-group">
					<input type="text" id="remetente" name="remetente" class="form-control" placeholder="bancobrasil@bb.com.br" required>
					<label for="remetente">Remetente(Ex:bancobrasil@bb.com.br)</label>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-group">
					<input type="text" id="assunto" name="assunto" class="form-control" placeholder="Assunto" required autofocus>
					<label for="assunto">Assunto</label>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="form-label-group">
					<input type="text" id="tela" name="tela" class="form-control" placeholder="Link Tela Fake" required autofocus>
					<label for="tela">Link Tela Fake</label>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="exampleFormControlTextarea1">HTML(Laytout Email)</label>
					<textarea class="form-control" id="html" name="html" rows="3"></textarea>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Lista(E-mails)</label>
					<textarea class="form-control" id="emails" name="emails" rows="3"></textarea>
				</div>
			</div>
		</div>
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Disparar Agora</button>
    </form>
  </body>
</html>