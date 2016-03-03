<?php
	class User{
		
		//-----------Attributs--------------
		
		private $_idUser;
		private $_identifiant;
		private $_password;
		
		//----------Constructeur------------
		
		public function __construct($data){
			$this->hydrate($data);
		}
		
		//------------Getter----------------
		
		public function getIdUser(){
			return $this->_idUser;
		}
		
		public function getIdentifiant(){
			return $this->_identifiant;
		}
		
		public function getPassword(){
			return $this->_password;
		}
		
		//------------Setter----------------
		
		public function setIdUser($idUser){
			$this->_idUser = $idUser;
		}
		
		public function setIdentifiant($identifiant){
			$this->_identifiant = htmlspecialchars($identifiant);
		}
		
		public function setPassword($password){
			$this->_password = htmlspecialchars($password);
		}
		
		//------------Hydrate---------------
		
		private function hydrate($data) {
			foreach($data as $key => $value){
				$method = 'set'.ucfirst($key);
				if(method_exists($this, $method)){
					$this->$method($value);
				}
			}
		}
		
	}
?>