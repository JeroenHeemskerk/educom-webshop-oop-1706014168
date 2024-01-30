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
	
    public function setCart($cartData) {
        $_SESSION['cart'] = $cartData;
    }

    public function getCart() {
        return $_SESSION['cart'] ?? null;
    }

    public function addToCart($item) {
        $_SESSION['cart'][] = $item;
    }
	
}

?>