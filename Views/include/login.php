<div class="container" id="logincontainer">

	<div class="col-md-6">
		<div id="logbox">
			<form id="signin" method="post" action="Private/Session/Connection.php">
				<h1>Se connecter</h1>
				<input name="identifiant" type="text" placeholder="Entrer votre nom" required="required" class="input pass"/>
				<input name="password" type="password" placeholder="Entrer votre mot de passe" required="required" class="input pass"/>
				<input type="submit" value="Se connecter" class="inputButton"/>
			</form>
		</div>
	</div>
	
	<div class="col-md-6">
		<div id="logbox">
			<div id="alreadyexist" class="lightbox zonebox">
				<a href="#_"></a>
				Cet identifiant existe déjà.
			</div>
			<form id="signup" method="post" action="Private/Session/Inscription.php">
				<h1>Créer un compte</h1>
				<input name="identifiant" type="text" placeholder="Votre identifiant" pattern="^[\w]{3,16}$" autofocus="autofocus" required="required" class="input pass"/>
				<input name="password" type="password" placeholder="Choisissez un mot de passe" required="required" class="input pass"/>
				<input name="password2" type="password" placeholder="Confirmez le mot de passe" required="required" class="input pass"/>
				<input type="submit" value="Sign me up!" class="inputButton"/>
			</form>
		</div>
	</div>
</div>
