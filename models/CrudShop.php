<?php

class ShopCrud {    
    private $pdo;

    //setting properties with default values
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "shops";

    function __construct() {
        $this->pdo = $this->connect();
    }

    function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetches associative array
            return $pdo;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    function createProduct($product) {
        $stmt = $this->pdo->prepare("INSERT INTO items (item_name, image_url, price) VALUES (?, ?, ?)");
        $stmt->execute([$product['item_name'], $product['image_url'], $product['price']]);
        return $this->pdo->lastInsertId(); //lastInsertId() not yet created. can also just return echo message
    }

    function createOrder($order) {
        $stmt = $this->pdo->prepare("INSERT INTO orders (item_id, amount, user_id) VALUES (?, ?, ?)");
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

$testShopCrud = new ShopCrud();
$product = $testShopCrud->readAllProducts(); 
print_r($product);

?>
