<?php

include_once "pageModel.php";
require_once "CrudFactory.php";

class ModelFactory {
    private $crudFactory;

    public function __construct(CrudFactory $crudFactory) {
        $this->crudFactory = $crudFactory;
    }

    public function createModel($type) {
        switch ($type) {
            case 'UserModel':
                return new UserModel($this->crudFactory->createCrud('user'));
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