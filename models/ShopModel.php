<?php

	require_once "pageModel.php";
    
class ShopModel extends pageModel {
    public $items = []; //empty array of items
    public $cart = []; //empty array of cart items
    public $orders = [];
    public $itemDetails;
    private $shopCrud;

    public function __construct($pageModel, ShopCrud $shopCrud) {
		PARENT:: __construct($pageModel);
        $this->shopCrud = $shopCrud;
        $this->cart = array();

	}

    public function prepareWebshopData() {
        //Call function to get items from database
        $items = $this->shopCrud->retrieveAllItems();
        $this->items = $items;
    }

    public function prepareOrderData($userId) {
            $orders = $this->shopCrud->retrieveOrderHistory($userId);
            $this->orders = $orders;

            if (empty($orders)) {
               $orders = "";
            } else {
                return $orders;
            }
    } 

    public function cartSpecificItemDetails($itemId) {
        $itemDetails = $this->shopCrud->retrieveSpecificItem("item_name", $itemId);
        return $itemDetails;
    }

    public function addToCart($userId, $itemId, $amount, $itemDetails) {
        //Add item to the cart array
        $this->cart = array(
            'userId' => $userId, 
            'itemId' => $itemId, 
            'amount' => $amount, 
            'item_name' => $itemDetails 
        ); 
    }

    public function setItemDetails($itemDetails) {
        $this->itemDetails = $itemDetails;
    }

    public function placeOrder($userId, $user) {
        $cart = $this->sessionManager->getCart();
        if (!empty($cart)) {
            foreach ($cart as $cartItem) {
                $itemId = $cartItem['itemId'];
                $amount = $cartItem['amount'];
                $userId = $_SESSION['user_id'];
                $user = $_SESSION['user'];
                $this->shopCrud->insertIntoOrdersTable($userId, $itemId, $amount);
            }

            //Clearing the cart after placing the order
            $this->sessionManager->clearCart();
            echo "Order placed successfully!";
        } else {
            echo "Your cart is empty. Add items before placing an order.";
        }
    }
}