<?php

class ShopCrud {
    private $crud;

    function __construct($crud) {
        $this->pdo = $pdo;
    }

    function createProduct($product) {
        $stmt = $this->pdo->prepare("INSERT INTO items (name, price) VALUES (?, ?)");
        $stmt->execute([$product['something'], $product['something']]);
        return $this->pdo->lastInsertId();
    }

    function createOrder($order) {
        $stmt = $this->pdo->prepare("INSERT INTO items (?, ?, ?) VALUES (?, ?, ?)");
        $stmt->execute([$order['item_id'], $order['amount'], $order['user_id']]);
        return $this->pdo->lastInsertId();
    }

    function readAllProducts() {
        $stmt = $this->pdo->prepare("SELECT * FROM items");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function readProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>