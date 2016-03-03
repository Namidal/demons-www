<?php
	require_once("User.class.php");
	
	class UserManager{
		
		//-----------Attributs--------------
		
		private $_db;
		
		//----------Constructeur------------
		
		public function __construct(PDO $db){
			$this->setDb($db);
		}
		
		//------------Setter----------------
		
		public function setDb(PDO $db){
			$this->_db = $db;
		}
		
		//-----------Fonciton---------------
		
		public function checkUserExist($Identifiant){
			$user = array();
			$sql = 'SELECT * FROM user where identifiant = :id';
			$req = $this->_db->prepare($sql);
			$req->bindParam(":id", $Identifiant, PDO::PARAM_STR);
			$req->execute();
			while($data = $req->fetch(PDO::FETCH_OBJ)){
				$user = $data;
			}
			$req->closeCursor();
			if(empty($user)) {
				return true;
			} else{
				return false;
			}
			
		}
		
		public function addUser(User $user){
			
			$idUser = $user->getIdUser();
			$identifiant = $user->getIdentifiant();
			$password = $user->getPassword();
			//INSERT INTO `dmm`.`user` (`idUser`, `identifiant`, `password`) VALUES (NULL, 'pomme', 'dapi');
			$sql = 'INSERT INTO user (idUser, identifiant, password) VALUES (:idUser, :identifiant, :password)';
			$req = $this->_db->prepare($sql);
			$req->bindParam(":idUser", $idUser, PDO::PARAM_INT);
			$req->bindParam(":identifiant", $identifiant , PDO::PARAM_STR);
			$req->bindParam(":password", $password, PDO::PARAM_STR);
			$req->execute();
			$req->closeCursor();
		}
	}
?>