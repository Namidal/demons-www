<?php
	session_start();
	if(isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant'])){
	header('location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="Public/css/menu.css" />
		<link rel="stylesheet" href="Public/css/index.css" />
		<link rel="stylesheet" href="Public/css/log.css" />
		<title>Démons &amp;&amp; Merveilles</title>
		<link rel="icon" type="image/png" href="image/DetM.png" />
		<script type="text/javascript" src="Public/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="Public/js/menuTableDropdown.js"></script>
	</head>

	<?php include 'Views/include/menu.php' ?> <!-- header -->
	
	<body class="container">
		<div  class="ider">
			<div id="logcontainer">
				<?php require 'Private/config.php'; ?>
				<?php require 'Private/core.php'; ?>
				<?php include 'Views/include/login.php'; ?>
			</div>
		</div>
	</body>
	
	<?php include 'Views/include/footer.php' ?> <!--footer -->
	
</html>
