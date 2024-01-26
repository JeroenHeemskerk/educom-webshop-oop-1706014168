<?php

	require_once "./views/BasicDoc.php";

class HomeDoc extends BasicDoc {
	
	public function __construct($model) {
		parent::__construct($model);
	}
	
	protected function showPageHeader() {
		echo 'Welcome to this webshop';
	}
	protected function showContent() {
		echo '<p>Any kind of product can be found under \'Browse shop\'</p>
			<br>
			<p>To buy products, firstly login</p>';
	}
	
}

?>