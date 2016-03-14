<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="Public/css/menu.css" />
		<link rel="stylesheet" href="Public/css/index.css" />
		<link rel="stylesheet" href="Public/css/TablesJDR.css" />
		<link rel="stylesheet" href="Public/css/log.css" />
		<title>Démons &amp;&amp; Merveilles</title>
		<link rel="icon" type="image/png" href="image/DetM.png" />
		<script type="text/javascript" src="Public/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="Public/js/menuTableDropdown.js"></script>
	</head>
	
	<?php include 'Views/include/menu.php' ?> <!-- header -->
	
	<body class="container">
		<div class="ider">
			<!-- Slider -->
			<?php 
			require_once("Private/config.php");
			$records = $db->prepare('SELECT idSession, maxTables, moment, start, end FROM adminsession WHERE moment!="Murder"');
			$records->execute();
	
			foreach($records as $row) {//On génère une animation pour chaque session de jeux.
				echo('
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#myCarousel"+'.$row['idSession'].').carousel({
								interval: 0
							});
								 
							$("#carousel"+'.$row['idSession'].'+"-text").html($("#slide-content"+'.$row['idSession'].'+"-0").html());
									 
							$("[id^=carousel-selector"+'.$row['idSession'].'+"-]").click( function(){
								var id = this.id.substr(this.id.lastIndexOf("-") + 1);
								var id = parseInt(id);
								$("#myCarousel"+'.$row['idSession'].').carousel(id);
							});
									 
							$("#myCarousel"+'.$row['idSession'].').on("slid.bs.carousel", function (e) {
								var id = $(".item.active.carouselitem'.$row['idSession'].'").data("slide-number");
								$("#carousel"+'.$row['idSession'].'+"-text").html($("#slide-content"+'.$row['idSession'].'+"-"+id).html());
							});
						});
					</script>
					
					<div id="Inscrit-'.$row['idSession'].'" class="container lightbox" style="text-align:center; background-color: rgb(250,250,250); font-size:20px;">
						<div class="row">
							<div class="col-md-12" id="slider'.$row['idSession'].'">
								<strong class="row">
									Vous êtes maintenant inscrit à cette table !
								</strong>
							</div>
						</div>
					</div>
					<div id="Table-'.$row['idSession'].'" class="container lightbox" style="text-align:center; background-color: rgb(250,250,250); font-size:20px;">
						<div class="row">
							<div class="col-md-12" id="slider'.$row['idSession'].'">
								<strong class="row">
									Votre partie est maintenant inscrite !
								</strong>
							</div>
						</div>
					</div>
					<div id="Delete-'.$row['idSession'].'" class="container lightbox" style="text-align:center; background-color: rgb(250,250,250); font-size:20px;">
						<div class="row">
							<div class="col-md-12" id="slider'.$row['idSession'].'">
								<strong class="row">
									Votre table à été supprimé avec succés !
								</strong>
							</div>
						</div>
					</div>
					
					<div class="container" style="padding-left:4%; padding-right:4%;">
						<div class="row">
							<div class="col-xs-12" id="slider'.$row['idSession'].'">
								<div class="row">
									<h2>'.$row['moment'].' de '.$row['start'].' à '.$row['end'].'</h2>
									<hr/>
									<div class="col-sm-8" id="carousel'.$row['idSession'].'-bounding-box">
										<div class="carousel slide" id="myCarousel'.$row['idSession'].'">
											<!-- Carousel items -->
											<div class="carousel-inner">
				');
				
				$index = 0;
				$records2 = $db->prepare('SELECT image, meneur, name, description, pjMax, ambiance, jdrName, experience FROM tablejdr WHERE moment=:moment');
				$records2->bindParam(":moment", $row['idSession']);
				$records2->execute();
			
				foreach($records2 as $row2) {//Pour chaque table
					if ($index == 0) {
						echo('
													<div style="height:400px; overflow-y:auto;" class="active item carouselitem'.$row['idSession'].'" data-slide-number="'.$index.'">
														<img style="margin:0px 30px 10px 0px; border: solid 5px #aaa; float:left; max-width:250px; max-height:400px;" src="'.$row2['image'].'">
														'.nl2br($row2['description']).'
													</div>
													
						');
					} else {
						echo('
													<div class="item carouselitem'.$row['idSession'].'" data-slide-number="'.$index.'">
														<img style="margin:0px 30px 10px 0px; border: solid 5px #aaa; float:left; max-width:250px; max-height:400px;" src="'.$row2['image'].'">
														'.nl2br($row2['description']).'
													</div>
													
						');
					}
					$index++;
				}
				$records2->closeCursor();
				
				if ($index == 0) { // S'il n'y a pas encore de table
					echo ('
													<div class="active item carouselitem'.$row['idSession'].'" data-slide-number="0">
													</div>
					');
				}
				
				echo('
												</div>                  
											</div>
										</div>
									
										<div class="col-sm-4" id="carousel'.$row['idSession'].'-text" style="height:430px;"></div>
											<div id="slide-content'.$row['idSession'].'" style="display: none;">
				');
				
				$index = 0;
				$records2 = $db->prepare('SELECT idTable, meneur, name, pjMax, ambiance, jdrName, experience, description, image, moment FROM tablejdr WHERE moment=:moment');
				$records2->bindParam(":moment", $row['idSession']);
				$records2->execute();
			
				foreach($records2 as $row2) {//Pour chaque table
					echo('
											<div id="slide-content'.$row['idSession'].'-'.$index.'">
												<h2>'.$row2['name'].'</h2>
												<p class="sub-text">Par : <strong>'.$row2['meneur'].'</strong></p>
												<p>Nom du jeu de rôle : <strong>'.$row2['jdrName'].'</strong></p>
												<p>Ambiance : <strong>'.$row2['ambiance'].'</strong></p>
												<p>Experience Roliste : <strong>'.$row2['experience'].'</strong></p>
												<p>Nombre de joueur maximum : <strong>'.$row2['pjMax'].'</strong></p>
												<p>Personnes inscrites : <strong>
					');
					
					$recordsuser = $db->prepare('SELECT iduser, estMJ FROM userlinkjdr WHERE idTable=:idtable');
					$recordsuser->bindParam(":idtable", $row2['idTable']);
					$recordsuser->execute();
					
					foreach($recordsuser as $rowuser) {//Pour chaque utilisateur joueurs, j'ajoute son nom à la liste.
						if($rowuser['estMJ'] == 0) {
						echo('- '.$rowuser['iduser'].' -');
						}
					}
					
					if (isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant'])) { //Si l'utilisateur est connecté, on vérifie s'il est inscrit à une table et si cette table est celle visualisé
					
						$records355 = $db->prepare('SELECT iduser FROM userlinkjdr WHERE session=:session AND iduser=:iduser AND idTable=:idTable AND estmj!=0');
						$records355-> bindParam(":session", $row2['moment']);
						$records355-> bindParam(":iduser", $_SESSION['identifiant']);
						$records355-> bindParam(":idTable", $row2['idTable']);
						$records355-> execute();
						
						$mj = array();
						
						while($data = $records355->fetch(PDO::FETCH_OBJ)){
							$mj = $data;
						}
						$records355->closeCursor();
							
						if(empty($mj) && $_SESSION['identifiant'] != "DMM") { //Ce n'est pas le maître du jeux de la partie présenté
					
							$records325 = $db->prepare('SELECT idTable FROM userlinkjdr WHERE session=:session AND iduser=:iduser');
							$records325->bindParam(":session", $row2['moment']);
							$records325->bindParam(":iduser", $_SESSION['identifiant']);
							$records325->execute();
							
							$user = array();
							
							while($data = $records325->fetch(PDO::FETCH_OBJ)){
								$user = $data;
							}
							$records325->closeCursor();
							
							if(empty($user)) { //Si l'utilisateur n'est pas encore inscrit sur cette série de session alors on lui propose de s'inscrire à la table.
								$records124 = $db->prepare('SELECT * FROM userlinkjdr WHERE idTable=:idTable');
								$records124->bindParam(":idTable", $row2['idTable']);
								$records124->execute();
								
								$conteur = 0;
								foreach($records124 as $data) {$conteur++;}
								if ($conteur < $row2['pjMax']) { //Quel chance, il reste une place !
									echo ('
										<div>
											<form id="signup" method="post" action="Private/JDRadduser.php">
												<input type="hidden" name="iduser" value="'.$_SESSION['identifiant'].'"/>
												<input type="hidden" name="idTable" value="'.$row2['idTable'].'"/>
												<input type="hidden" name="session" value="'.$row2['moment'].'"/>
												<input type="submit" value="S\'inscrire à la table" class="inputButton"/>
											</form>
										</div>
									');
								} else {
									echo('
										<div>
											<p>Il n\'y a plus de place libre pour cette table<p>
										</div>
									');
								}
							} else { //Sinon, on regarde si on est dans la table choisi pour la session, et si c'est le cas, on lui propose l'option de désinscription.
								$records35 = $db->prepare('SELECT * FROM userlinkjdr WHERE session=:session AND iduser=:iduser AND idTable=:idTable');
								$records35-> bindParam(":session", $row2['moment']);
								$records35-> bindParam(":iduser", $_SESSION['identifiant']);
								$records35-> bindParam(":idTable", $row2['idTable']);
								$records35-> execute();
								
								$user = array();
								
								while($data = $records35->fetch(PDO::FETCH_OBJ)){
									$user = $data;
								}
								$records35->closeCursor();
								
								if(!empty($user)) {
									echo ('
										<div>
											<form id="signup" method="post" action="Private/JDRdeleteuser.php">
												<input type="hidden" name="iduser" value="'.$_SESSION['identifiant'].'"/>
												<input type="hidden" name="idTable" value="'.$row2['idTable'].'"/>
												<input type="hidden" name="session" value="'.$row2['moment'].'"/>
												<input type="submit" value="Je dois me désinscrire" class="inputButton"/>
											</form>
										</div>
									');
								}
							
							}
						} else { //Si c'est le maître du jeu de la partie présenté:
							echo ('
										<div>
											<a class="image158" style="width:100%;" href="#lightbox-'.$row2['idTable'].'"><input type="submit" value="Modifier la partie" class="inputButton"/></a>
										</div>
										
										<div id="lightbox-'.$row2['idTable'].'" class="lightbox zonebox">
											<a href="#_""></a>
											<div id="logbox" class="container col-xl-10" style="width:1170px;">
												<hr/>
												<form  method="post" action="Private/JDRchangeTable.php">
												<div class="col-md-6">
													<h1>Information sur la partie</h1>
													<input name="idTable" type="hidden" value="'.$row2['idTable'].'"/>
													<input value="'.$row2['name'].'" name="name" type="text" placeholder="Nom de la partie" required="required" class="input"/>
													<input value="'.$row2['jdrName'].'" name="jdrName" type="text" placeholder="Nom du jeu de rôle" required="required" class="input"/>
													<input value="'.$row2['pjMax'].'" name="pjMax" type="text" placeholder="Nombre de joueurs" required="required" class="input"/>
													<input value="'.$row2['ambiance'].'" name="ambiance" type="text" placeholder="Ambiance de jeux" required="required" class="input"/>
													<input value="'.$row2['experience'].'" name="experience" type="text" placeholder="Experience rôliste des joueurs" required="required" class="input"/>
													
												</div>
												<div class="col-md-6">
													<h1>Description de la partie</h1>
													<textarea name="description" type="textarea" placeholder="Une description de votre partie" required="required" class="input" style="height:180px;"/>'.$row2['description'].'</textarea>
													<input value="'.$row2['image'].'" name="image" type="text" placeholder="Entrer une URL d\'image pour illustrer votre partie" class="input"/>
													<input type="submit" value="Modifier les informations" class="inputButton" style="position:relative; top:60px;"/>
												</div>
												</form>
												<div class="col-md-6">
													<form method="post" action="Private/JDRdeleteTable.php">
														<input name="idTable" type="hidden" value="'.$row2['idTable'].'"/>
														<input name="Session" type="hidden" value="'.$row['idSession'].'"/>
														<input type="submit" value="Supprimer la partie" class="deleteButton" style="margin-bottom:0px; margin-top:0px; position:relative; top: -20px;"/>
													</form>
												</div>
											</div>
										</div>
							');					
						}
					}
					
					echo ('
												
												</strong></p>
											</div>
					');
					$index++;
				}
				
				if ($index == 0) { //S'il n'y a pas encore de table
					echo ('
											<div id="slide-content'.$row['idSession'].'-'.$index.'">
												<h2></h2>
												<p class="sub-text">Par : <strong></strong></p>
												<p>Nom du jeu de rôle : <strong></strong></p>
												<p>Ambiance : <strong></strong></p>
												<p>Experience Roliste : <strong></strong></p>
												<p>Nombre de joueur maximum : <strong></strong></p>
												<p>Personnes inscrites : <strong></strong></p>
											</div>
					');
				}
				
				
				echo ('
										</div>
									</div>
								</div>
								
								<!--/Slider-->
								<div class="row hidden-xs" id="slider-thumbs'.$row['idSession'].'">
									<!-- Bottom switcher of slider -->
									<ul class="hide-bullets">
				');
				
				$index = 0;
				$records2 = $db->prepare('SELECT name, jdrName FROM tablejdr WHERE moment=:moment');
				$records2->bindParam(":moment", $row['idSession']);
				$records2->execute();
				
				foreach($records2 as $row2) {//Pour chaque table
					
					$spread = 25;
					$r = rand($spread, 255-$spread);
					$g = rand($spread, 255-$spread);
					$b = rand($spread, 255-$spread);
					echo('
										<li class="col-sm-3" style="position:relative; margin-left:15px; margin-right:-30px;">
											<a id="carousel-selector'.$row['idSession'].'-'.$index.'" class="thumbnail image158" style="width:100%; height:150px; text-align:center; vertical-align:middle;">
												<p style="background: rgba('.$r.','.$g.','.$b.',0.1); margin:0; height:140px; width:calc(100%-5px); z-index:50; position:absolute;"></p>
												<p style="background: rgba('.$r.','.$g.','.$b.',0.5); margin:0; height:140px; width:100%;"></p>
												<p class="specialp" style="width:100%; height:100%;">
													<span style="width:215px; height:140px; text-align:center; vertical-align:middle;">'.$row2['name'].'</span>
												</p>
											</a>
										</li>
					');
					$index++;
				}
				
				$index = 0;
				$recordsTableSession = $db->prepare('SELECT * FROM tablejdr WHERE moment=:moment');
				$recordsTableSession->bindParam(":moment", $row['idSession']);
				$recordsTableSession->execute();
				
				$recordsMaxTable = $db->prepare('SELECT maxTables FROM adminsession WHERE idSession=:moment');
				$recordsMaxTable->bindParam(":moment", $row['idSession']);
				$recordsMaxTable->execute();
				
				$records325 = $db->prepare('SELECT idTable FROM userlinkjdr WHERE session=:session AND iduser=:iduser');
				$records325->bindParam(":session", $row['idSession']);
				$records325->bindParam(":iduser", $_SESSION['identifiant']);
				$records325->execute();				
				$user = array();					
				while($data = $records325->fetch(PDO::FETCH_OBJ)){
					$user = $data;
				}
				$records325->closeCursor();
				
				while($data = $recordsTableSession->fetch(PDO::FETCH_OBJ)){
					$index++;
				}
				$recordsTableSession->closeCursor();
				
				$MaxTable=0;
				
				foreach($recordsMaxTable as $rowMaxTable) {//Pour chaque utilisateur joueurs, j'ajoute son nom à la liste.
					$MaxTable = $rowMaxTable['maxTables'];
				}
				$recordsMaxTable->closeCursor();
				
				if ($MaxTable > $index && empty($user) && isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant'])) { //S'il peut encore y avoir des tables et que la personne n'est inscrit à aucune table, il peut en créer une.
					echo ('
									
										
										<li class="col-sm-3" style="position:relative; margin-left:15px; margin-right:-30px;">
											<a class="thumbnail image158" style="width:100%;" href="#lightbox'.$row['idSession'].'" style="height:150px; width:100%;">
												<p id="carousel-selector'.$row['idSession'].'-0" style="margin:0; height:140px; width:100%;"><img src="Public/image/-text.png" height=140px width=100%></p>
												<p class="specialp"><span></span></p>
											</a>
										</li>
										<!-- lightbox container hidden with CSS -->
										
										<div id="lightbox'.$row['idSession'].'" class="lightbox zonebox">
											<a href="#_""></a>
											<form id="logbox col-lg-10" method="post" action="Private/JDRaddTable.php" class="container">
												<hr/>
												<div class="col-md-6">
													<h1>Information sur la partie</h1>
													<input name="moment" type="hidden" value="'.$row['idSession'].'"/>
													<input name="meneur" type="hidden" value="'.$_SESSION['identifiant'].'"/>
													<input name="name" type="text" placeholder="Nom de la partie" required="required" class="input"/>
													<input name="jdrNAME" type="text" placeholder="Nom du jeu de rôle" required="required" class="input"/>
													<input name="pjMax" type="text" placeholder="Nombre de joueurs" required="required" class="input"/>
													<input name="ambiance" type="text" placeholder="Ambiance de jeux" required="required" class="input"/>
													<input name="experience" type="text" placeholder="Experience rôliste des joueurs" required="required" class="input"/>
													
												</div>
												<div class="col-md-6">
													<h1>Description de la partie</h1>
													<textarea name="description" type="textarea" placeholder="Une description de votre partie" required="required" class="input" style="height:180px;"/></textarea>
													<input name="image" type="text" placeholder="Entrer une URL d\'image pour illustrer votre partie" class="input"/>
													<input type="submit" value="Inscrire sa partie" class="inputButton"/>
												</div>
											</form>
										</div>
					');
				}
				
				echo ('
									</ul>
								</div>
								<hr/>
							</div>
					</div>x
				');					
			}
			?>
		</div>
	</body>
</html>
