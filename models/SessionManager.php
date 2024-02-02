<?php

class SessionManager {
	
    public function __construct() {
        session_start();
    }

    public function setUser() {
        $_SESSION['user'] = $this->user;
    }

    public function getUser(){
        return $_SESSION['user'] ?? null;
    }

    public function logoutUser() {
        echo "logging out user";
		unset($_SESSION['user']);
		unset($_SESSION['user_id']);
		unset($_SESSION['cart']);
    }
	
    public function setCart($cartData) {
        $_SESSION['cart'] = $cartData;
    }

    public function getCart() {
        return $_SESSION['cart'] ?? null;
    }

    public function addToCart($item) {
        $_SESSION['cart'][] = $item;
    }

    public function clearCart() {
        echo "Clear Cart function called.";
		if (isset($_SESSION['cart'])) {
			//Clear the cart session
			unset($_SESSION['cart']);
			echo "Cart cleared successfully!";
		} else {
			echo "Your cart is already empty.";
		}
    }
	
}

?>