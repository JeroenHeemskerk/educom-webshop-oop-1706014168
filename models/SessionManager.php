<?php

class SessionManager {
	
    public function __construct() {
        session_start();
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

    public function addToSessionCart($item) {
        $_SESSION['cart'][] = $item;
    }

    public function clearCart() {
		unset($_SESSION['cart']);
    }
	
}