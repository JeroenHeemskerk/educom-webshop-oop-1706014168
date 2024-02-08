<?php

require_once "./controllers/PageController.php";
require_once "./models/Crud.php";
require_once "./models/CrudFactory.php";
require_once "./models/ModelFactory.php";

$crud = new Crud();
$crudFactory = new CrudFactory($crud);
$userCrud = $crudFactory->createCrud('user');

$modelFactory = new ModelFactory($crudFactory);

$pageController = new PageController($modelFactory, $crudFactory); //passing model/crud Factory to PageController
$pageController->handleRequest();


?>