<?php
  include_once "../views/basicDoc.php";

  $data = array ( 'page' => 'basic', /* other fields */ );

  $view = new BasicDoc($data);
  $view  -> show();
?>