<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>DISPAROS :: TELA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.4/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    <header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">DISPAROS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Nova Campanha</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="campanhas.php">Campanhas</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="emails-disparos.php">Emails</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="novo-email.php">Novo Email</a>
        </li>
      </ul>
    </div>
  </nav>
</header>



<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
  <div class="container">
	
	<?php 
	
		if(isset($_POST['email']) && $_POST['email'] != '')
		{
			include("config.php");
			
			$email 		= $_POST['email'];
			$senha 		= $_POST['senha'];
			
			$date = date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d'))));
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
	
	<form class="form-signin" action="" id="formID" method="POST">
	  <div class="text-center mb-4">
		<h1 class="h3 mb-3 font-weight-normal">Cadastrar E-mail de envio</h1>
	  </div>

		<div class="row">
			<div class="col-lg-6">
				<div class="form-label-group">
					<label for="email">E-mail</label>
					<input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-label-group">
					<label for="senha">Senha</label>
					<input type="text" id="senha" name="senha" class="form-control" placeholder="Senha" required>
				</div>
			</div>
		</div>
	  <br>
	  <button class="btn btn-lg btn-primary btn-block" id="send" type="submit">Cadastrar Agora</button>
	</form>
	
	<?php 
		}
	?>
	
  </div>
</main>



<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">DISPAROS <?php date('Y'); ?>.</span>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script></body>
</html>
