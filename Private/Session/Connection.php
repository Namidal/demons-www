<?php
	require '../config.php';
	$identifiant = htmlspecialchars($_POST["identifiant"]);
	$password = htmlspecialchars($_POST["password"]);
	$PasCrypt = sha1($password);
	
	$records = $db->prepare('SELECT idUser FROM  user WHERE identifiant= :identifiant AND password= :password');
	$records->bindParam(":identifiant", $identifiant);
	$records->bindParam(":password", $PasCrypt);
	$records->execute();
	
	while($results = $records->fetch(PDO::FETCH_OBJ)){
		$user = $results;
	}
	$records->closeCursor();
	if(!empty($user)){
		session_start();
		$_SESSION['identifiant'] = $identifiant;
		header('Location: ../../index.php');
	} else {
		header('Location: ../../connection.php');
	}
?>
