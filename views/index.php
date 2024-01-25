<?php

require_once "../views/BasicDoc.php";

//not sure whether these are strictly necessary:

require_once "../views/HomeDoc.php";
require_once "../views/WebshopDoc.php";
require_once "../views/LoginForm.php";
require_once "../views/RegistrationForm.php";
require_once "../views/ContactForm.php";

$pageIdentifier = isset($_GET['page']) ? $_GET['page'] : 'default'; 

$data = array();

// Create an instance of BasicDoc
$basicDoc = new BasicDoc("data for BasicDoc");

//Create an instance of HomeDoc

// Call the showResponsePage method to determine and display the appropriate page
$basicDoc->showResponsePage($pageIdentifier);

?>