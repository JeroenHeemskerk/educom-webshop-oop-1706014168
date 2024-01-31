<?php

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

    public function cartSpecificItemDetails($itemId) {
        $itemDetails = get_specific_item_details($this->connection, $itemId);
        return $itemDetails;
    }

    public function addToCart($userId, $itemId, $amount, $itemDetails) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        //Add item to the cart array
        $this->cart[] = array('userId' => $userId, 'itemId' => $itemId, 'amount' => $amount, 'item_name' => implode(" ",$itemDetails)); 
        $_SESSION['cart'] = $this->cart;
    }

    public function setItemDetails($itemDetails) {
        $this->itemDetails = $itemDetails;
    }

    public function placeOrder($userId, $user) {
        if (!empty($this->cart)) {
            foreach ($this->cart as $cartItem) {
                $itemId = $cartItem['itemId'];
                $amount = $cartItem['amount'];
                $this->insertIntoOrdersTable($this->connection, $itemId, $user, $userId, $amount);
            }

            //Clearing the cart after placing the order
            $this->cart = [];
            echo "Order placed successfully!";
        } else {
            echo "Your cart is empty. Add items before placing an order.";
        }
    }
}