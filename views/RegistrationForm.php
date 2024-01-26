<?php

	require_once "./views/FormsDoc.php";

class RegistrationForm extends FormsDoc {
	
	protected function showPageHeader() {
		echo '<h1>Welcome to registration</h1>';
	}
	
	protected function showContent() {
		echo '<br><form method="post">
		<div> //later styling
		<label for="user">Enter username:</label>
		<input type="text" id="user" name="register_user" value="' . $this->model->user . '"> <!--ID is used for javascript and css styling. name is used for form submission -->
		<span class= "error">' . $this->model->userEr . '</span>
		</div>
		<div>
		<label for="password">Enter password:</label>
		<input type="password" id="password" name="register_password">
		</div>
		<div>
		<label for="password2">Enter password again:</label>
		<input type="password" id="password2" name="register_password_2">
		</div>
		<input type="hidden" name="page" value="register">
		<button type="submit" name="register_submit">Submit registration</button>
	</form><br>';
	}
}


?>