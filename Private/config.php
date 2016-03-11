<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=dmm;charset=utf8','dmm','p4snyjzVzmwW4Bhd');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
?>