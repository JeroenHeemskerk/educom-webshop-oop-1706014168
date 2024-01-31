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
            $_SESSION['cart'] = [];
        }
        //Add item to the cart array
        $_SESSION['cart'][] = array(
            'userId' => $userId, 
            'itemId' => $itemId, 
            'amount' => $amount, 
            'item_name' => implode(" ",$itemDetails) //it had previously been returned as an array
        ); 
    }

    public function setItemDetails($itemDetails) {
        $this->itemDetails = $itemDetails;
    }

    public function placeOrder($userId, $user) {
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $cartItem) {
                $itemId = $cartItem['itemId'];
                $amount = $cartItem['amount'];
                $userId = $_SESSION['user_id'];
                $user = $_SESSION['user'];
                insert_into_orders_table($this->connection, $itemId, $user, $userId, $amount);
            }

            //Clearing the cart after placing the order
            unset($_SESSION['cart']);
            echo "Order placed successfully!";
        } else {
            echo "Your cart is empty. Add items before placing an order.";
        }
    }
}