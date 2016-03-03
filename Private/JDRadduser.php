<?php
	$iduser = $_POST["iduser"];
	$idTable = $_POST["idTable"];
	$session = $_POST["session"];
	
	require_once("config.php");
	$selec = array();
	$req1 = $db->prepare('SELECT * FROM userlinkjdr WHERE iduser=:iduser AND idTable=:idtable');
	$req1->	bindParam(":iduser", $iduser);
	$req1->	bindParam(":idTable", $idTable);
	$req1->execute();
	while($data = $req1->fetch(PDO::FETCH_OBJ)){
		$selec = $data;
	}
	$req1->closeCursor();
	if(empty($selec)) {
		header('Location: ../TablesJDR.php');
	}
	
	
	$req = $db->prepare('INSERT INTO userlinkjdr (iduser, idTable, session) VALUES (:iduser, :idTable, :session)');
	$req->bindParam(":iduser", $iduser);
	$req->bindParam(":idTable", $idTable);
	$req->bindParam(":session", $session);
	$req->execute();
	$req->closeCursor();
	
	header('Location: ../TablesJDR.php#Inscrit-'.$_POST["session"]);
?>