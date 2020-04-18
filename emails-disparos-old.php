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
	
		include("config.php");
		
		$sql = "SELECT * FROM smtp ORDER BY id_smtp DESC";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
	
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
			<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
			<h3>E-mails de envios</h3>
			<table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">E-mail</th>
				  <th scope="col">Senha</th>
				  <th scope="col">Deletar</th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
					foreach($rows as $i => $v)
					{
						echo '<tr>
								  <th scope="row">'.$v['id_smtp'].'</th>
								  <td>'.$v['email'].'</td>
								  <td>'.$v['senha'].'</td>
								  <td><a href="apagar-smtp.php?id_smtp='.$v['id_smtp'].'">X</a></td>
								</tr>';
					}
				?>
			  </tbody>
			</table>
			
		</div>
	</div>

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
