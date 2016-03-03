<div id="head" class="hidden-xs hidden-sm">
	<img id="headImage" src="Public/image/TitreDM.png" alt="Demons et Merveilles"/>
</div>
		
<div id="head" class="hidden-lg hidden-md">
	<img id="headImage" src="Public/image/DetM.png" alt="Demons et Merveilles"/>
</div>

<div class="container">
	<nav class="nav-main">
	    <div class="region region-header-menu">
		<div id="block-system-main-menu" class="block block-system block-menu">
		    <div class="content">
			<ul class="nav nav-pills nav-main" id="mainMenu">
			
				<li class="dropdown 218"> 
					<a href="index.php" class="dropdown-toggle disabled active">Accueil</a>
				</li>
				<li class="dropdown 1777">
					<a href="TablesJDR.php" >Jeux de Rôles</a>
				</li class="dropdown 1777">
				<li class="dropdown 1777">
					<a href="murder.php" title="">Murder</a>
				</li>
				<li>
				<?php
				session_start();
				if (isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant'])) {
				echo('<a href="deconnection.php" title="">Deconnexion</a>');
				} else {
				echo('<a href="connection.php" title="">Connexion</a>');
				}
				?>
				</li>
				<li class="dropdown 1777">
					<a href="partenaires.php" title="">Partenaires</a>
				</li>
				<li>
				<?php
				if (isset($_SESSION['identifiant']) && $_SESSION['identifiant']=="DMM") {
				echo('<a href="admin.php" title="">Administrer</a>');
				}
				?>
				</li>				
			</div>
		</div>
	</nav>
</div>
