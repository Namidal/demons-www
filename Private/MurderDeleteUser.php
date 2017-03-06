<?php
	require 'config.php';
	$identifiant = $_POST["indentifiant"];
	$req = $db->prepare('DELETE FROM usermurder WHERE user = :identifiant');
	$req->bindParam(":identifiant", $identifiant);
	$req->execute();
	
	$req = $db->prepare('DELETE FROM userlinkjdr WHERE iduser = :identifiant AND idTable="0"');
	$req->bindParam(":identifiant", $identifiant);
	$req->execute();
	$req->closeCursor();

	header('Location: ../murder.php');
?>
