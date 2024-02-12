<?php

include_once "IShopCrud.php";

class Test_ShopCrud implements IShopCrud {  
    public $sqlQueries = array();  
    public $arrayToReturn = array();  
    public function retrieveAllItems() {    
        array_push($this->sqlQueries, "retrieveAllItems");    
        return $this->arrayToReturn;       
    }  
}
