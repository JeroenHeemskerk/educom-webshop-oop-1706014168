<?php

include_once "IShopCrud.php";

class Test_ShopCrud implements IShopCrud {  
    public $sqlQueries = array();  
    public $arrayToReturn = array();  
    public function getAllProducts() {    
        array_push($this->sqlQueries, "getAllProducts");    
        return $this->arrayToReturn;       
    }  
}

?>