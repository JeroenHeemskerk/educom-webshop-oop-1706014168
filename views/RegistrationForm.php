<?php

	require_once "../views/FormsDoc.php";

class RegistrationForm extends FormsDoc {
	
	protected function showPageHeader() {
		echo 'Welcome to registration';
	}
	
	protected function showContent() {
		echo '<form method="post">
		<label for="user">Enter username:</label>
		<input type="text" id="user" name="register_user"> <!--ID is used for javascript and css styling. name is used for form submission -->
		<label for="password">Enter password:</label>
		<input type="password" id="password" name="register_password">
		<button type="submit" name="register_submit">Submit registration</button>
	</form>';
	}
}


?>