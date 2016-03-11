<?php
	require 'config.php';
	$identifiant = $_POST["identifiant"];
	$mail = $_POST["mail"];
	$sql = 'UPDATE usermurder SET mail=:newmail WHERE user=:identifiant';
	$req = $db->prepare($sql);
	$req->bindParam(":newmail", $mail);
	$req->bindParam(":identifiant", $identifiant);
	$req->execute();
	$req->closeCursor();
	header('Location: ../murder.php');
?>