<?php

class SessionManager {
	
    public function __construct() {
        session_start();
    }

    public function setUser($userData) {
        $_SESSION['user'] = $userData;
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
	
}

?>