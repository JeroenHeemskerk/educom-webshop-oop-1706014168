<?php

	require_once "pageModel.php";

class UserModel extends pageModel {
	public $name;
	public $nameEr;
	public $user = "";
	public $userEr = "";
	public $password = "";
	public $password_2 = "";
	public $passwordEr = "";
	public $password2Er = "";
	public $email = "";
	public $emailEr = "";
	public $valid = false;
	public $comment = "";
	public $commentEr = "";
	
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
					$userData = $this->authenticateUser($this->user, $this->password); 
					if ($userData !== null) {
						$this->userEr = "Gebruiker bestaat al!";
					} else {
						$this->valid = true;
						//save user
						$result = $this->saveUser($this->user, $this->password);
					}
			}
		}
	}

	public function validateMessage() {
		//do validation
		if ($this->isPost) {
			$this->name = $this->getPostVar('contact_name');
			if (empty($this->name)) {
				$this->nameEr = "Naam is verplicht";
			}
	
			$this->email = $this->getPostVar('contact_email');
			if (empty($this->email)) {
				$this->emailEr = "email is verplicht";
			}
	
			$this->comment = $this->getPostVar('comment_box');
			if (empty($this->comment)) {
				$this->commentEr = "veld leeg: vul een bericht in";
			}
	
			if (empty($this->nameEr) && empty($this->emailEr) && empty($this->commentEr)) {
				$this->valid = true;
			}
		}
	}
	
	public function authenticateUser() {
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

	public function hash_password() {
		$hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
		return $hashedPassword;
	}

	public function saveUser() {
		$hashedPassword = $this->hash_password();
		add_user_database_pdo($this->connection, $this->user, $hashedPassword);
	}
}


?>