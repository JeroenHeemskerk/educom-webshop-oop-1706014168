<?php

  include_once "./views/ContactForm.php";
  
$data = array();

$contactForm1 = new ContactForm($data);

$contactForm1 -> show();

?>