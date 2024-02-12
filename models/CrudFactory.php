<?php

require_once "Crud.php";
require_once "CrudUser.php";
require_once "CrudShop.php";

class CrudFactory {
    private $crud;

    public function __construct(Crud $crud) {
        $this->crud = $crud;	
    }

    public function createCrud($name) {
        switch($name) {
            case 'user':
                return new UserCrud($this->crud);
            case 'shop':
                return new ShopCrud($this->crud);
            default:
                throw new Exception("That case is not an actual CRUD name: $name");
        }
    }

}