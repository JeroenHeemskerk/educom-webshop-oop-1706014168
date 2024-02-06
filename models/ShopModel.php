<?php

	require_once "pageModel.php";
    
class ShopModel extends pageModel {
    public $items = []; //empty array of items
    public $cart = []; //empty array of cart items
    public $orders = [];

    private $shopCrud;

    public function __construct($pageModel, ShopCrud $shopCrud) {
		PARENT:: __construct($pageModel);
        $this->shopCrud = $shopCrud;

	}

    public function prepareWebshopData() {
        //Call function to get items from database
        $items = $this->shopCrud->retrieveAllItems();
        $this->items = $items;
    }

    public function prepareOrderData() {
        if(isset($_SESSION['user'])) {
            $userId = $_SESSION['user_id'];
            $orders = $this->shopCrud->retrieveOrderHistory($userId);
            $this->orders = $orders;

            if (empty($orders)) {
               $orders = "";
            } else {
                return $orders;
            }
        } else {
            echo "you're not logged in!";
        }
    }

    public function cartSpecificItemDetails($itemId) {
        $itemDetails = $this->shopCrud->retrieveSpecificItem("item_name", $itemId);
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
            'item_name' => $itemDetails //before it had to implode
        ); 
    }

    public function setItemDetails($itemDetails) {
        $this->itemDetails = $itemDetails;
    }

    public function placeOrder($userId, $user) {
        $cart = $this->sessionManager->getCart();
        if (!empty($cart)) {
            foreach ($_SESSION['cart'] as $cartItem) {
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