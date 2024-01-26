<?php

	require_once "./views/FormsDoc.php";

class LoginForm extends FormsDoc {
	
	protected function showPageHeader() {
		echo 'Welcome to login';
	}
	
	protected function showContent() {
		echo '<br><form method="post">
		<div>
		<label for="user" name="login_user">Enter username:</label>
		<input type="text" id="user" name="login_user" value="' . $this->model->user . '"> <!--ID is used for javascript and css styling. name is used for form submission -->
		<span class= "error">' . $this->model->userEr . '</span>
		</div>
		<div>
		<label for="password name="register_password" name="login_password" value="' . $this->model->password . '">Enter password:</label>
		<input type="password" id="password" name="login_password">
		<span class= "error"> ' . $this->model->passwordEr . '</span>
		</div>
		<div>
		<label for="password" name="register_password_2" value="' . $this->model->password . '">Confirm password:</label>
		<input type="password" id="password" name="login_password_2">
		<span class= "error"> ' . $this->model->passwordEr . ' </span>
		</div>
		<input type="hidden" name="page" value="login">
		<button type="submit" name="login_submit">Submit login</button>
	</form><br>';
	}
}

?>