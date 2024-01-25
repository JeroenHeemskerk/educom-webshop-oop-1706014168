<?php

	require_once "../views/BasicDoc.php";

class HomeDoc extends BasicDoc {
	
	
	protected function showHeader() {
		echo '<header>';
		
		echo '</header>';
	}
	protected function showContent() {
		echo 'This is the homepage of the website';
	}
	
}

?>