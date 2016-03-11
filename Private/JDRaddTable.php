<?php
	require_once("config.php");
	$req = $db->prepare('INSERT INTO tablejdr (moment, meneur, description, pjMax, ambiance, jdrNAME, experience, name, image) VALUES (:moment, :meneur, :description, :pjMax, :ambiance, :jdrNAME, :experience, :name, :image)');
	$req->bindParam(":moment", $_POST['moment']);
	$req->bindParam(":meneur", $_POST['meneur']);
	$req->bindParam(":description", $_POST['description']);
	$req->bindParam(":pjMax", $_POST['pjMax']);
	$req->bindParam(":ambiance", $_POST['ambiance']);
	$req->bindParam(":jdrNAME", $_POST['jdrNAME']);
	$req->bindParam(":experience", $_POST['experience']);
	$req->bindParam(":name", $_POST['name']);
	$req->bindParam(":image", $_POST['image']);
	$req->execute();
	
	$req1 = $db->prepare('SELECT idTable FROM tablejdr WHERE moment=:session AND meneur=:iduser');
	$req1->bindParam(":session", $_POST['moment']);
	$req1->bindParam(":iduser", $_POST['meneur']);
	$req1->execute();
	
	foreach($req1 as $data){
		$idTable = $data['idTable'];
	}
	
	$req2 = $db->prepare('INSERT INTO userlinkjdr (iduser, idTable, session, estmj) VALUES (:iduser, :idTable, :session, 1)');
	$req2->bindParam(":iduser", $_POST['meneur']);
	$req2->bindParam(":idTable", $idTable);
	$req2->bindParam(":session", $_POST['moment']);
	$req2->execute();
	$req2->closeCursor();
	
	header('Location: ../TablesJDR.php#Table-'.$_POST['moment']);
?>