<?php

class TestShopCrud implements IShopCrud {  
    public $sqlQueries = array();  
    public $arrayToReturn = array();  
    public getAllProducts() {    
        array_push($this->$sqlQueries, "getAllProducts");    
        return $this->arrayToReturn;  
    }  // ... }

?>