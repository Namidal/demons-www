<?php
	$check = 1;
		
	if(!(isset($_POST["identifiant"]) && htmlspecialchars($_POST["identifiant"]) != "")){
		$check = 0;
	}
	
	if(isset($_POST["password"]) && htmlspecialchars($_POST["password"]) != ""){
		if(!(isset($_POST["password2"]) && htmlspecialchars($_POST["password2"]) == $_POST["password"])) {
			$check = 0;
		}
	}else{
		$check = 0;
	}
	
	if($check == 1){
		
		require_once("../config.php");
		require_once("../../Models/UserManager.class.php");
		$userManager = new UserManager($db);
		if(!($userManager->checkUserExist(htmlspecialchars($_POST["identifiant"])))){
		header('Location: connection.php');
		}else{
			$PasCrypt = sha1(htmlspecialchars($_POST["password"]));
			$data = array(
				"idUser" => NULL,
				"identifiant" => htmlspecialchars($_POST["identifiant"]),
				"password" => $PasCrypt
			);
			$user = new User($data);
			$userManager->addUser($user);
			session_start();
			$_SESSION['identifiant'] = $_POST["identifiant"];
			header('Location: ../../index.php');
		}
	}

	header('Location: ../../connection.php');
?>
