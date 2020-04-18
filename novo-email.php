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
	
		if(isset($_POST['email']) && $_POST['email'] != '')
		{
			include("config.php");
			
			$email 		= $_POST['email'];
			$senha 		= $_POST['senha'];
			
			$date = date('Y-m-d');
			$enviado = 0;
			$sql = "INSERT INTO smtp (email, senha, date, enviado) VALUES(:email, :senha, :date, :enviado)";
			$stmt = $PDO->prepare( $sql );
			$stmt->bindParam( ':email', $email , PDO::PARAM_STR);
			$stmt->bindParam( ':senha', $senha , PDO::PARAM_STR);
			$stmt->bindParam(':date', $date, PDO::PARAM_STR);
			$stmt->bindParam(':enviado', $enviado, PDO::PARAM_STR);
			 
			$result = $stmt->execute();
			
			$id_smtp = $PDO->lastInsertId();
			 
			if ( ! $result )
			{
				var_dump( $stmt->errorInfo() );
				exit;
			}
			 
			if($stmt->rowCount() > 0)
			{
				echo '<div class="alert alert-success" role="alert">E-mail enviado.<br><a href="novo-email.php">Novo E-mail</a><br><a href="index.php">P&aacute;gina Inicial</a></div><br>'; 
			}
			
			
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
				<h1 class="h3 mb-3 font-weight-normal">Cadastrar E-mail de envio</h1>
			  </div>

				<div class="row">
					<div class="col-lg-6">
						<div class="form-label-group">
							<input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
							<label for="email">E-mail</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-label-group">
							<input type="text" id="senha" name="senha" class="form-control" placeholder="Senha" required>
							<label for="senha">Senha</label>
						</div>
					</div>
				</div>
			  
			  <button class="btn btn-lg btn-primary btn-block" id="send" type="submit">Cadastrar Agora</button>
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
