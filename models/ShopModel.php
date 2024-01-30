<?php

session_start();

	require_once "pageModel.php";
    
class ShopModel extends pageModel {
    public $items = []; //empty array of items
    public $cart = []; //empty array of cart items

    public function __construct($pageModel) {
		PARENT:: __construct($pageModel);
	}

    public function prepareWebshopData() {
        //Call function to get items from database
        $items = get_items($this->connection);

        $this->items = $items;
    }

    public function prepareCartData() {
        $cart = 



    }

    //add cart

    //add previous orders

}