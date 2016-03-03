<?php
	require '../config.php';
	$sql = 'UPDATE adminsession SET maxTables=:maxTables, idSession=:idSession, start=:start, end=:end, moment=:moment WHERE ident=:ident';
	$req = $db->prepare($sql);
	$req->bindParam(":maxTables", $_POST["maxTables"]);
	$req->bindParam(":idSession", $_POST["idSession"]);
	$req->bindParam(":start", $_POST["start"]);
	$req->bindParam(":end", $_POST["end"]);
	$req->bindParam(":moment", $_POST["moment"]);
	$req->bindParam(":ident", $_POST["ident"]);
	$req->execute();
	$req->closeCursor();

	header('Location: ../../admin.php');
?>
