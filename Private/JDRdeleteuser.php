<?php
	require 'config.php';
	$req = $db->prepare('DELETE FROM userlinkjdr WHERE iduser=:iduser AND idTable=:idTable AND session=:session');
	$req->bindParam(":iduser", $_POST["iduser"]);
	$req->bindParam(":idTable", $_POST["idTable"]);
	$req->bindParam(":session", $_POST["session"]);
	$req->execute();
	header('Location: ../TablesJDR.php');
?>