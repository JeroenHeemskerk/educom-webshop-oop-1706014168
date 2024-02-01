<?php

require_once "./controllers/PageController.php";
//require_once "./models/CrudFactory.php";

/*
work in progress 

$crud = new Crud();
$crudFactory = new CrudFactory($crud);
$modelFactory => new ModelFactory(crudFactory);
*/

$pageController = new PageController();
$pageController->handleRequest(); 

?>