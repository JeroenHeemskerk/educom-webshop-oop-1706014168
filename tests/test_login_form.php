<?php

  include_once "./views/LoginForm.php";
  
$data = array();  
  
$loginForm1 = new LoginForm($data);

$loginForm1 -> show();


?>