<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>DISPAROS :: TELA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css" rel="stylesheet">
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
	
	
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  -->
	
	
  </head>

  <body class="text-center">
  
	
	<?php 
	
		if(isset($_POST['nome']) && $_POST['nome'] != '')
		{
			include("config.php");
			
			$nome 		= $_POST['nome'];
			$remetente 	= $_POST['remetente'];
			$assunto 	= $_POST['assunto'];
			$ativada	= 1;
			$html 		= htmlentities($_POST['html']); // html_entity_decode para buscar no banco
			
			$sql = "INSERT INTO campanha (nome, remetente, assunto, html, ativada) VALUES(:nome, :remetente, :assunto, :html, :ativada)";
			$stmt = $PDO->prepare( $sql );
			$stmt->bindParam( ':nome', $nome , PDO::PARAM_STR);
			$stmt->bindParam( ':remetente', $remetente , PDO::PARAM_STR);
			$stmt->bindParam( ':assunto', $assunto , PDO::PARAM_STR);
			$stmt->bindParam( ':html', $html , PDO::PARAM_STR);
			$stmt->bindParam( ':ativada', $ativada , PDO::PARAM_INT);
			 
			$result = $stmt->execute();
			
			$id_campanha = $PDO->lastInsertId();
			 
			if ( ! $result )
			{
				var_dump( $stmt->errorInfo() );
				exit;
			}
			 
			if($stmt->rowCount() > 0)
			{
				$retorno = 'Campanha Inserida';
			}
			
			$text = trim($_POST['emails']);
			$textAr = explode("\n", $text);
			$textAr = array_filter($textAr, 'trim');

			$quantidadeEmails = 0;
			$enviado = 0;
			foreach ($textAr as $email) 
			{
				$sqlEmail = "INSERT INTO email (id_campanha, email, enviado) VALUES(:id_campanha, :email, :enviado)";
				$stmtEmail = $PDO->prepare( $sqlEmail );
				$stmtEmail->bindParam(':id_campanha', $id_campanha, PDO::PARAM_STR);
				$stmtEmail->bindParam(':email', $email, PDO::PARAM_STR);
				$stmtEmail->bindParam(':enviado', $enviado, PDO::PARAM_INT);
				$resultEmail = $stmtEmail->execute();
				$quantidadeEmails++;
			} 
			
			$sqlUpdate = "UPDATE campanha SET qtde_email = :qtde_email, qtde_enviada = :qtde_enviada WHERE id_campanha = :id_campanha ";
			$stmtUpdate = $PDO->prepare( $sqlUpdate );
			$stmtUpdate->bindParam(':qtde_email', $quantidadeEmails, PDO::PARAM_STR);
			$stmtUpdate->bindParam(':qtde_enviada', $enviado, PDO::PARAM_INT);
			$stmtUpdate->bindParam(':id_campanha', $id_campanha, PDO::PARAM_STR);
			$resultUpdate = $stmtUpdate->execute();
			
			echo '<div class="alert alert-success" role="alert">Campanha enviada.<br><a href="index.php">P&aacute;gina Inicial</a></div><br>'; 
		}
		else
		{
		
		
	?>
	
	
	<div class="row" style="width: 100%;">
		<div class="col-lg-2">
			<div class="dropdown">
			  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				A&ccedil;&otilde;es
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="index.php">Nova Campanha</a>
				<a class="dropdown-item" href="campanhas.php">Campanhas</a>
				<a class="dropdown-item" href="emails-disparos.php">E-mails de disparo</a>
				<a class="dropdown-item" href="novo-email.php">Novo E-mail de disparo</a>
			  </div>
			</div>
		</div>
		<div class="col-lg-10">
			<form class="form-signin" action="" id="formID" method="POST" style="margin-top: -150px; max-width: 100%;">
			  <div class="text-center mb-4">
				<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
				<h1 class="h3 mb-3 font-weight-normal">Nova Campanha - Envios</h1>
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
				
				<!--<div class="row">
					<div class="col-lg-12">
						<div class="form-label-group">
							<input type="text" id="tela" name="tela" class="form-control" placeholder="Link Tela Fake" required autofocus>
							<label for="tela">Link Tela Fake</label>
						</div>
					</div>
				</div>-->
				
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
			  
			  <button class="btn btn-lg btn-primary btn-block" id="send" type="submit">Disparar Agora</button>
			</form>
		</div>
	</div>
	
  
    
	<?php 
		}
	?>
  </body>
  <script>
	var formID = document.getElementById("formID");
	var send = $("#send");

	$(formID).submit(function(event){
	  if (formID.checkValidity()) {
		send.attr('disabled', 'disabled');
	  }
	});
  </script>
</html>