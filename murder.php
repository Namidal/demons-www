<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Pyblic/css/log.css" />
		<link rel="stylesheet" href="Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="Public/css/menu.css" />
		<link rel="stylesheet" href="Public/css/index.css" />
		<!--<link rel="stylesheet" href="Public/css/log.css" />-->
		<link rel="stylesheet" href="Public/css/murder.css" />
		<title>Démons &amp;&amp; Merveilles</title>
		<link rel="icon" type="image/png" href="image/DetM.png" />
		<script type="text/javascript" src="Public/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="Public/js/menuTableDropdown.js"></script>
	</head>

	<?php include 'Views/include/menu.php' ?> <!-- header -->
	
	
	<body class="container">
	<div  class="ider">
		<div class="col-lg-1">
		</div>
		<div class="col-lg-10">
			<div class="container text-center" align=left style="text-align: justify; text-justify: inter-word;">
				<br/>
				<p>Dimanche 11h-17h par Gris Alexandre.</p>
				
				<p style="fontsize:large;">Miroir. miroir, qui est le plus riche ?</p>
				<p>Ambiance : Moderne Fantastique</p>
				<p>Âge : 13+</p>
				<br>
				<p>
				Avec sa collection de meubles anciens (en chêne massif et en marbre, évidemment), il est évident que Niko avait besoin d’aide pour emménager dans sa nouvelle maison de campagne. C’est ce que vous vous étiez dit avant d’arriver et de découvrir que non seulement les meubles n’étaient pas là, mais que Niko non plus. Pourtant, sa famille, arrivée la veille, est certaine d’avoir déjà fait une bonne partie du travail et que Niko était de toute évidence encore là. La voiture de Niko est encore garée et il n’apparaît sur aucune des caméras qui surveillent l’extérieur.
				<br>La recherche de Niko prend une autre tournure, quand quelqu'un d'autre a disparu...</p>
				<!-- Espace réservé au responsable de la murder -->
				<?php
				if (isset($_SESSION['identifiant']) && ($_SESSION['identifiant']=="Murder" ||$_SESSION['identifiant']=="DMM")) {
					echo('<table border=2 class="table table-striped table-condensed"<tr><th>Utilisateur</th><th>eMail</th><th>Rôle</th><th>Modifier Rôle</th></tr>');
					require_once("Private/config.php");
					$records = $db->prepare('SELECT user, mail, role FROM usermurder');
					$records->execute();
	
					foreach($records as $row) {
						echo ("<tr><td>".$row['user']."</td><td>".$row['mail'] ."</td><td>".$row['role'].'</td><td>
							<form id="changerole" method="post" action="Private/MurderRoleChange.php">
								<input type="hidden" name="identifiant" value="'.$row['user'].'"/>
								<input name="NouveauRole" type="text"/>
								<input type="submit" value="Modifier"/>
							</form>
							<form id="deleterole" method="post" action="Private/MurderDeleteUser.php">
								<input type="hidden" name="identifiant" value="'.$row['user'].'"/>
								<input type="submit" value="Delete"/>
							</form></td></tr>'
						);
					}
				echo ('</table><hr/></div><br/><br/><div class="container text-center" align=left>');}
				?>
				
				<!-- Espace pour les personnes connecté, on test si elles sont déjà inscrite ou non -->
				
				<?php
				require_once("Private/config.php");
				$records = $db->prepare('SELECT idSession FROM adminsession WHERE moment="Murder"');
				$records->execute();
				
				foreach($records as $row) {
					$idS = $row['idSession'];
				}
				
				require_once("Private/config.php");
				$records325 = $db->prepare('SELECT * FROM userlinkjdr WHERE session=:session AND iduser=:iduser AND idTable!=0');
				$records325->bindParam(":session", $idS);
				$records325->bindParam(":iduser", $_SESSION['identifiant']);
				$records325->execute();
				
				$user = array();
							
				while($data = $records325->fetch(PDO::FETCH_OBJ)){
					$user = $data;
				}
				$records325->closeCursor();
				
				if (empty($user)) {						
					if (isset($_SESSION['identifiant'])){
					
						require_once("Private/config.php");
						$user = array();
						$req = $db->prepare('SELECT * FROM usermurder WHERE user = :id');
						$req->bindParam(":id", $_SESSION['identifiant']);
						$req->execute();
						while($data = $req->fetch(PDO::FETCH_OBJ)){
							$user = $data;
						}
						$req->closeCursor();
						
						if(empty($user) && $_SESSION['identifiant'] != "Murder") { //Si $user est vide alors il n'y avait aucun utilisateur inscrit à la murder avec ce nom.			
						echo ('
						<hr/><div>
							<form id="signin" method="post" action="Private/MurderAddUser.php">
							<h1>Inscription à la Murder</h1>
							<input type="hidden" name="identifiant" value="'.$_SESSION['identifiant'].'"/>
							<input type="hidden" name="session" value="'.$idS.'"/>
							<input type="email" name="mail" placeholder="Entrer votre mail" required="required" class="input pass"/>
							<input type="submit" value="Inscrit-moi !" class="inputButton"/>
							</form>
						</div>
						');
						} else { // Sinon, l'utilisateur est déjà inscrit et on peut lui afficher les données suivantes.
							$req = $db->prepare('SELECT mail,role FROM usermurder WHERE user=:id');
							$req->bindParam(":id", $_SESSION['identifiant']);
							$req->execute();
							foreach($req as $row) {
								if (empty($row['role'])) {
									echo ('
										<div class="container text-center">
											<hr/>
											<p class="col-md-12">
											Le meneur de jeux ne vous a pas encore assigné de rôles, ça ne devrait plus tarder.
											</p>
										</div>
									');
								} else {
									echo ('
										<div class="container text-center">
											<hr/>
											<p class="col-md-12">
											Il semblerait que l\'on vous ai assigné le rôle de '.$row['role'].' durant cette partie !
											</p>
										</div>
									');
								}
								
								echo ('
									<div class="container text-center">
										<hr/>
										<p class="col-md-12">
										Vous êtes inscrit à la Murder, vous recevrez plus d\'information par mail à votre adresse '.$row['mail'].' de la part des meneurs de jeux.
										</p>
									</div>
									<hr/>
									<div class="container text-center">
										<form id="signin" method="post" action="Private/MurderChangeMail.php">
										
										<input type="hidden" name="identifiant" value="'.$_SESSION['identifiant'].'" class="col-md-1"/>
										<input type="email" name="mail" placeholder="Je veux changer mon mail" required="required" class="input"/>
										<div class="col-md-1"></div>
										<input type="submit" value="Nouveau mail" class="inputButton col-md-2">
										</form>
									</div>
									<hr/>
									<div class="container text-center">
										<form id="signin" method="post" action="Private/MurderDeleteUser.php">
										<input type="hidden" name="identifiant" value="'.$_SESSION['identifiant'].'"/>
										<input type="submit" value="Finalement, je dois me désister" class="inputButton">
										</form>
									</div>
									<hr/>
								');
							}
						}
					}
				}
				?>			
				
				<!-- Espace visible par tout le monde -->
				<?php
				require_once("Private/config.php");
				$query = 'SELECT COUNT(*) FROM usermurder';
				echo ('<p>Il y a actuellement ');
				foreach ($db->query($query) as $row){
					echo "$row[0]";
				}
				$query2 = 'SELECT COUNT(*) FROM usermurder WHERE role!=""';
				echo (' personnes inscrites dont ');
				foreach ($db->query($query2) as $row){
					echo "$row[0]";
				}
				echo (' confirmé-e-s par les meneur-se-s de jeux.</p>');
				?>
			</div>
		</div>
	</div>
	</body>
	
	<?php include 'Views/include/footer.php' ?> <!--footer -->
	
</html>
