<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../../Public/css/monwe.css" />
		<title>Démons &amp;&amp; Merveilles</title>
		<link rel="icon" type="image/png" href="Image/DetM.png" />
		<script type="text/javascript" src="Public/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="Public/js/menuTableDropdown.js"></script>
	</head>
	
	<body>
	
	<?php
		require_once("../../Private/config.php");
		
		$req1 = $db->prepare('SELECT idTable FROM tablejdr WHERE moment=:session AND meneur=:iduser');
		$req1->bindParam(":session", $_POST['moment']);
		$req1->bindParam(":iduser", $_POST['meneur']);
		$req1->execute();
		
		foreach($req1 as $data){
			$idTable = $data['idTable'];
		}
	?>
		<div class="rotate">
			<p>
			simple
			</p>
		</div>
	</body>

</html>