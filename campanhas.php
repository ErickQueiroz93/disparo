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
	<?php 
	
		include("config.php");
		
		$sql = "SELECT * FROM campanha ORDER BY id_campanha DESC";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
	
	?>
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
	<h3>Todas as campanhas</h3>
	<table class="table">
	  <thead class="thead-dark">
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">Nome</th>
		  <th scope="col">Remetente</th>
		  <th scope="col">Assunto</th>
		  <th scope="col">Engenharia</th>
		  <th scope="col">Quantidade</th>
		  <th scope="col">Enviadas</th>
		  <th scope="col">Situa&ccedil;&atilde;o</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<?php 
			foreach($rows as $i => $v)
			{
				$sqlContaEnviados = "SELECT SUM(enviado) AS qtde FROM email WHERE enviado = 1 AND id_campanha = '".$v['id_campanha']."' GROUP BY enviado";
				$resultContaEnviados = $PDO->query( $sqlContaEnviados );
				$rowsContaEnviados = $resultContaEnviados->fetch();
				
				if($v['ativada'] == 1)
				{
					$situacao = 'Disparando';
				}
				else
				{
					$situacao = 'Finalizada';
				}
				
				echo '<tr>
						  <th scope="row">'.$v['id_campanha'].'</th>
						  <td>'.$v['nome'].'</td>
						  <td>'.$v['remetente'].'</td>
						  <td>'.$v['assunto'].'</td>
						  <td>
						  
							<!-- Large modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">VER</button>

							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg">
								<div class="modal-content">
								  <div style="width: 100%; height: 600px;">
									'.html_entity_decode($v['html']).'
								  </div>
								</div>
							  </div>
							</div>
						  
						  </td>
						  <td>'.$v['qtde_email'].'</td>
						  <td>'.$rowsContaEnviados['qtde'].'</td>
						  <td>'.$situacao.'</td>

						</tr>';
			}
		?>
	  </tbody>
	</table>
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
