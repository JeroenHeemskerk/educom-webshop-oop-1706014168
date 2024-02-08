<?php

include_once "pageModel.php";
include_once "UserModel.php";
require_once "CrudFactory.php";
include_once "ShopModel.php";


class ModelFactory {
    private $crudFactory;
    private $model;

    public function __construct(CrudFactory $crudFactory) {
        $this->crudFactory = $crudFactory;
    }

    public function createModel($type) {
        switch ($type) {
            case 'UserModel':
                //needs to have second parameter to call constructor of pagemodel(?)
                $this -> model = new UserModel($this->model, $this->crudFactory->createCrud('user'));
                break;
            case 'ShopModel':
                $this -> model = new ShopModel($this->model, $this->crudFactory->createCrud('shop'));
                break;
            case 'PageModel':
                $this -> model = new PageModel(NULL);
                break;
            default:
                throw new Exception("That is not an actual Model type: $type");
        }
        return $this->model;
    }

}

?>
