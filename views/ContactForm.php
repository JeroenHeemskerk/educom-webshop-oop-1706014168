<?php

	require_once "../views/FormsDoc.php";

class ContactForm extends FormsDoc {
	
	
	protected function showPageHeader() {
		echo '<h1>Contact Details</h1>';
	}
	
	protected function showBodyContent() {
		echo '<p>Email: Rosevalley@gmail.com</p>
			<br>
			<p>To buy products, firstly login</p>';
	}
}
?>