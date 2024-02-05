<?php

require_once "./controllers/PageController.php";
require_once "./models/CrudFactory.php";
require_once "./models/ModelFactory.php";

$crudFactory = new CrudFactory();
$userCrud = $crudFactory->createCrud('user');

$modelFactory = new ModelFactory($crudFactory);

$pageController = new PageController($modelFactory); //passing modelFactory to PageController
$pageController->handleRequest();


?>