<?php
	require 'config.php';
	$req = $db->prepare('DELETE FROM usermurder WHERE user = :identifiant');
	$req->bindParam(":identifiant", $_POST["identifiant"]);
	$req->execute();
	
	$req = $db->prepare('DELETE FROM userlinkjdr WHERE iduser = :identifiant AND idTable="0"');
	$req->bindParam(":identifiant", $_POST["identifiant"]);
	$req->execute();
	
	header('Location: ../murder.php');
?>