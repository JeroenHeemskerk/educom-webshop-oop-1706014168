<?php

	require_once "pageModel.php";

class UserModel extends pageModel {
	public $name;
	public $user = "";
	public $password = "";
	public $password_2 = "";
	public $userEr = "";
	public $passwordEr = "";
	public $password2Er = "";
	public $valid = false;
	
	public function __construct($pageModel) {
		PARENT:: __construct($pageModel);
	}
	
	public function validateLogin() {
		//do validation
		if ($this->isPost) {
			$this->user = $this->getPostVar('login_user'); //check if correct
			if (empty($this->user)) {
				$this->userEr = "Gebruikersnaam is verplicht"; // fixed variable name
			}
	
			$this->password = $this->getPostVar('login_password');
			if (empty($this->password)) {
				$this->passwordEr = "Password is verplicht";
			}
			if (empty($this->userEr) && empty($this->passwordEr)) {
				$userData = $this->authenticate_user($this->user, $this->password); // fixed variable name
				if ($userData == null || $userData == "password incorrect") { // fixed variable name
					$this->userEr = "Gebruiker onbekend of verkeerd password";
				} else {
					$this->valid = true;
				}
			}
		}
	}
	
	public function validateRegistration() {
			//do validation
		if ($this->isPost) {
			$this->user = $this->getPostVar('register_user');
			if (empty($this->user)) {
				$this->userEr = "Gebruikersnaam is verplicht";
			} 
			
			$this->password = $this->getPostVar('register_password');
			if (empty($this->password)) {
				$this->passwordEr = "Password is verplicht";
			}
			if (empty($this->userEr) && empty($this->passwordEr)) { //both fields filled in?
					$userData = $this->authenticate_user($this->user, $this->password); 
					if ($userData !== null) {
						$this->userEr = "Gebruiker bestaat al!";
					} else {
						$this->valid = true;
					}
			}
		}
	}
	
	public function authenticate_user() {
			// Authenticate username
		$userData = retrieve_userdata($this->connection, $this->user);

		if ($userData !== null) {
			// Username exists, now verify the password
			$hashedPassword = $userData['password_hashed'];

			if (password_verify($this->password, $hashedPassword)) {
				// Password is correct
				return "credentials correct";
			} else {
				// Password is incorrect
				return "password incorrect";
			}
		} else {
			// Username does not exist
			return null;
		}
	}
}


?>