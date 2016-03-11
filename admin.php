<?php
session_start();
	if (!isset($_SESSION['identifiant']) || !($_SESSION['identifiant']=="DMM")) {
	header('Location: index.php');
	}
	session_write_close();
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="Public/css/menu.css" />
		<link rel="stylesheet" href="Public/css/index.css" />
		<title>Démons &amp;&amp; Merveilles</title>
		<link rel="icon" type="image/png" href="image/DetM.png" />
		<script type="text/javascript" src="Public/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="Public/js/menuTableDropdown.js"></script>
	</head>
	
	<?php include 'Views/include/menu.php' ?> <!-- header -->
	
	<body class="container">
		<div class="ider">
			<div class="container text-center">
				<hr/>
				<div class="row">
					<div class="col-lg-12">
						<!-- Cette partie sert à gérer les tables de JDR -->
						<?php
							echo('<table border=2 class="table table-striped table-condensed"><tr><th>idSession</th><th>nom</th><th>Tables maximum</th><th>Débût</th><th>Fin</th><th>Changer</th><th>Supprimer</th></tr>');
							require_once("Private/config.php");
							$records = $db->prepare('SELECT ident, idSession, maxTables, moment, start, end FROM adminsession');
							$records->execute();
			
							foreach($records as $row) {
								echo ('
									<tr>
										<form method="post" action="Private/Admin/changeSessionMaxTable.php">
											<input type="hidden" name="ident" value="'.$row['ident'].'" class="col-xs-12">
											<td><input type="int" name="idSession" value="'.$row['idSession'].'" class="col-xs-12"/></td>
											<td><input type="text" name="moment" value="'.$row['moment'].'" class="col-xs-12"/></td>
											<td><input type="int" name="maxTables" value="'.$row['maxTables'].'" class="col-xs-12"/></td>
											<td><input type="text" name="start" value="'.$row['start'].'" class="col-xs-12"/></td>
											<td><input type="text" name="end" value="'.$row['end'].'" class="col-xs-12"/></td>
											<td><input type="submit" value="Modifier"></td>
										</form>
										<form method="post" action="Private/Admin/deleteSession.php">
											<td>
												<input type="hidden" name="ident" value="'.$row['ident'].'"/>
												<input type="submit" value="Supprimer"/>
											</td>
										</form>
									</tr>
								');
							}	
						?>
						
						<form id="changerole" method="post" action="Private/Admin/newSession.php">
							<tr>
								<td><input name="idSession" type="int" style="width:100%"/></td>
								<td><input name="moment" type="text" style="width:100%"/></td>
								<td><input name="maxTables" type="int" style="width:100%"/></td>
								<td><input name="start" type="text" style="width:100%"/></td>
								<td><input name="end" type="text" style="width:100%"/></td>
								<td><input type="submit" value="Ajouter"/></td>
								<td></td>
							</tr>
						</form>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</body>

	<?php include 'Views/include/footer.php' ?> <!--footer -->
	
</html>
