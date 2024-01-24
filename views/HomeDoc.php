<?php

	require_once "../views/BasicDoc.php";

class HomeDoc extends BasicDoc {
	
	
	protected function showHeader() {
		echo '<header>';
	}
	protected function showContent() {
		
	}
	
	protected function closeHeader() {
		echo '</header>';
	}
}

?>