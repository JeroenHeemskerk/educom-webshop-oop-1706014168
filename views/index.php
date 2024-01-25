<?php

require_once "../views/BasicDoc.php";

$pageIdentifier = isset($_GET['page']) ? $_GET['page'] : 'default';

// Create an instance of BasicDoc
$basicDoc = new BasicDoc("data for BasicDoc");

// Call the showResponsePage method to determine and display the appropriate page
$basicDoc->showResponsePage($pageIdentifier);

?>