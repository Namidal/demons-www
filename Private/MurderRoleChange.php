<?php
	require 'config.php';
	$identifiant = $_POST["identifiant"];
	$role = $_POST["NouveauRole"];
	$sql = 'UPDATE usermurder SET role=:newrole WHERE user=:identifiant';
	$req = $db->prepare($sql);
	$req->bindParam(":newrole", $role);
	$req->bindParam(":identifiant", $identifiant);
	$req->execute();
	$req->closeCursor();
	header('Location: ../murder.php');
?>