<?php

  include_once "../views/RegistrationForm.php";
  
$data = array();  
  
$registrationForm1 = new RegistrationForm($data);

$registrationForm1 -> show();

?>