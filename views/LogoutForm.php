<?php

	require_once "./views/FormsDoc.php";

class LogoutForm extends FormsDoc {
	
	protected function showPageHeader() {
		echo 'Welcome to logout page';
	}
	
    protected function showContent() { 
			echo '<form method="post">';
			echo '<input type="hidden" id="page" name="page" value="logout">';
			echo '<td><button type="submit" class="submit" name="logout">Logout</button></td>';
			echo '</form>';
	}
}

?>