<?php

include_once "pageModel.php";
include_once "UserModel.php";
require_once "CrudFactory.php";


class ModelFactory {
    private $crudFactory;

    public function __construct(CrudFactory $crudFactory) {
        $this->crudFactory = $crudFactory;
    }

    public function createModel($type) {
        switch ($type) {
            case 'UserModel':
                //needs to have second parameter to call constructor of pagemodel(?)
                return new UserModel($this->createModel('PageModel'), $this->crudFactory->createCrud('user'));
            case 'ShopModel':
                return new ShopModel($this->crudFactory->createCrud('shop'));
            case 'PageModel':
                return new PageModel(NULL);
            default:
                throw new Exception("That is not an actual Model type: $type");
        }
    }

}


?>