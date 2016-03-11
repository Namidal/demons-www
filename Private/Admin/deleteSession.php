<?php
	require '../config.php';
	$req = $db->prepare('DELETE FROM adminsession WHERE ident = :ident');
	$req->bindParam(":ident", $_POST["ident"]);
	$req->execute();
	header('Location: ../../admin.php');
?>
