<?php

session_start();

	require_once "pageModel.php";
    
class ShopModel extends pageModel {
    public $items = []; //empty array of items
    public $cart = []; //empty array of cart items
    public $orders = [];

    public function __construct($pageModel) {
		PARENT:: __construct($pageModel);
	}

    public function prepareWebshopData() {
        //Call function to get items from database
        $items = get_items($this->connection);

        $this->items = $items;
    }

    public function prepareOrderData() {
        $orders = get_order_history($this->connection);
        $this->orders = $orders;
    }

    //add cart

    //add previous orders

}