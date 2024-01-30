<?php

  include_once "../views/WebshopDoc.php";

$connection = connect_to_database();

$data = array();  
  
$webShopDoc1 = new WebshopDoc($data);

$webShopDoc1 -> show();

$shopModel = new ShopModel($pageModel, $connection);

?>