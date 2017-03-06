<?php
	try{
		$db = new PDO('mysql:host=mariadb;dbname=dmm;charset=utf8','dmm','GtrRtinzyi$w');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
?>
