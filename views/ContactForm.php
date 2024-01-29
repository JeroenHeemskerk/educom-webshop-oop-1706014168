<?php

	require_once "./views/FormsDoc.php";

class ContactForm extends FormsDoc {
	
	
	protected function showPageHeader() {
		echo '<h1>Contact Details</h1>';
	}
	
	protected function showContent() {
		echo '<p>Email: Rosevalley@gmail.com</p>
			<br>
			<p>To buy products, firstly login</p>
			<p>To contact owner, fill in form:</p>';
			
		echo '<br><form method="post">
		<div>
		<label for="user">Enter your name:</label>
		<input type="text" id="user" name="contact_name" value="' . $this->model->name . '"> <!--ID is used for javascript and css styling. name is used for form submission -->
		<span class= "error">' . $this->model->nameEr . '</span>
		</div>
		<div>
		<label for="email">Enter password:</label> <!--change to email, define property-->
		<input type="text" id="email" name="contact_email value="' . $this->model->email . '">
		<span class= "error"> ' . $this->model->emailEr . '</span>
		</div>
		<div>
		<label for="comment">Write your comment here</label>
		<input type="textarea" id="comment_box" name="comment_box" value ="' . $this->model->comment . '">
		<span class= "error"> ' . $this->model->commentEr . ' </span>
		</div>
		<input type="hidden" name="page" value="contact">
		<button type="submit" name="contact_submit">Submit message</button>
	</form><br>';
	}
	
}
?>