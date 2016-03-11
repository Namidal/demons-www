<?php
	require_once('../config.php');
	$idSession = htmlspecialchars($_POST["idSession"]);
	$moment = htmlspecialchars($_POST["moment"]);
	$maxTables = htmlspecialchars($_POST["maxTables"]);
	$start = htmlspecialchars($_POST["start"]);
	$end = htmlspecialchars($_POST["end"]);

	$req = $db->prepare('INSERT INTO adminsession (idSession, moment, maxTables,start, end) VALUES (:idSession, :moment, :maxTables, :start, :end)');
	$req->bindParam(":idSession", $idSession);
	$req->bindParam(":moment", $moment);
	$req->bindParam(":maxTables", $maxTables);
	$req->bindParam(":start", $start);
	$req->bindParam(":end", $end);
	$req->execute();
	
	
	header('Location: ../../admin.php');
?>
