<?php
	include("config.php");
	
	$id_smtp = $_GET['id_smtp'];
	$sql = "DELETE FROM smtp WHERE id_smtp = :id_smtp";
	$stmt = $PDO->prepare( $sql );
	$stmt->bindParam( ':id_smtp', $id_smtp );
	 
	$result = $stmt->execute();
	 
	if ( ! $result )
	{
		var_dump( $stmt->errorInfo() );
		echo '<script>alert("Erro"); window.location="emails-disparos.php"</script>';
		exit;
	}
	 
	if($stmt->rowCount() > 0)
	{
		echo '<script>alert("Email deletado"); window.location="emails-disparos.php"</script>';
	}
	else
	{
		echo '<script>alert("Email nao deletado"); window.location="emails-disparos.php"</script>';
	}