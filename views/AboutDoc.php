<?php

	require_once "../views/BasicDoc.php";

class AboutDoc extends BasicDoc {
	
	protected function showHeader() {
		echo '<header>';
		
		echo '</header>';
	}
	
	protected function showContent() {
		echo 'This is the about page of the website';
	}
}

?>