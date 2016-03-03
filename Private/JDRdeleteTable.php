<?php
	require 'config.php';
	$req = $db->prepare('DELETE FROM tablejdr WHERE idTable=:idTable');
	$req->bindParam(":idTable", $_POST["idTable"]);
	$req->execute();
	
	$req = $db->prepare('DELETE FROM userlinkjdr WHERE idTable=:idTable');
	$req->bindParam(":idTable", $_POST["idTable"]);
	$req->execute();
	
	header('Location: ../TablesJDR.php#Delete-'.$_POST["Session"]);
?>
