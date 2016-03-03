<?php
	require 'config.php';
	$sql = 'UPDATE tablejdr SET name=:name, jdrName=:jdrName, pjMax=:pjMax, ambiance=:ambiance, experience=:experience, description=:description, image=:image WHERE idTable=:idTable';
	$req = $db->prepare($sql);
	$req->bindParam(":name", $_POST['name']);
	$req->bindParam(":jdrName", $_POST['jdrName']);
	$req->bindParam(":pjMax", $_POST['pjMax']);
	$req->bindParam(":ambiance", $_POST['ambiance']);
	$req->bindParam(":experience", $_POST['experience']);
	$req->bindParam(":description", $_POST['description']);
	$req->bindParam(":image", $_POST['image']);
	$req->bindParam(":idTable", $_POST['idTable']);
	$req->execute();
	$req->closeCursor();
	header('Location: ../TablesJDR.php');
?>