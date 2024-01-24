<?php

	require_once "../views/BasicDoc.php";

abstract class FormsDoc extends BasicDoc {
	
	
	public function showBodyContent() {
		echo '<form action ="form_example.php" method="post">';
		echo '	<label for= "name">Name:</label>';
		echo '	<input type= "text" id= "name" name= "name">';
		echo '	<input type= "submit" value= "Submit">';
		echo '</form>';
	}
}	

?>