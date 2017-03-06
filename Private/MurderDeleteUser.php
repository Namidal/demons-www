<?php
	require 'config.php';

	$req = $db->prepare('DELETE FROM usermurder WHERE user = :identifiant');
	$req->bindParam(":identifiant", $_POST["identifiant"]);
	$req->execute();
	$req->closeCursor();
	
	$req2 = $db->prepare('DELETE FROM userlinkjdr WHERE iduser = :identifiant AND idTable="0"');
	$req2->bindParam(":identifiant", $_POST["identifiant"]);
	$req2->execute();

	$req2->closeCursor();

	header('Location: ../murder.php');
?>
