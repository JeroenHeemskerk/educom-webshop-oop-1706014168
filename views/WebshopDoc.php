<?php

//Not sure what this should show. Perhaps it should make the database connections.

	require_once "../views/ProductDoc.php";

class WebshopDoc extends ProductDoc {
	
	protected function showPageHeader() {
		echo '<h1>Webshop all details here</h1>';
	}
	
	protected function showContent() {
		echo '<p>Email: Rosevalley@gmail.com</p>
			<br>
			<p>To buy products, firstly login please! This is the browse shop page for members</p>';
	}
}

?>