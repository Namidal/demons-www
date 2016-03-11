<?php
	require("config.php");
	$req = $db->prepare('INSERT INTO usermurder (user, mail) VALUES (:identifiant, :mail)');
	$req->bindParam(":identifiant", $_POST["identifiant"]);
	$req->bindParam(":mail", $_POST["mail"]);
	$req->execute();
	
	$req = $db->prepare('INSERT INTO userlinkjdr (iduser, idTable, session) VALUES (:iduser, 0, :session)');
	$req->bindParam(":iduser", $_POST["identifiant"]);
	$req->bindParam(":session", $_POST["session"]);
	$req->execute();
	
	header('Location: ../murder.php');
?>
