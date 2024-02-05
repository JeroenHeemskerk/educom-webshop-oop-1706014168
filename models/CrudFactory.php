<?php

require_once "Crud.php";
require_once "CrudUser.php";
require_once "CrudShop.php";

class CrudFactory {

    public function createCrud($name) {
        switch($name) {
            case 'user':
                return new UserCrud(new Crud());
            case 'shop':
                return new ShopCrud(new Crud());
            default:
                throw new Exception("That is not an actual CRUD name: $name");
        }
    }

}


?>