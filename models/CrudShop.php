<?php

require_once "Crud.php";

class ShopCrud {    
    private $pdo;

    //setting properties with default values
    private $crud;
    private $table;

    public function __construct(Crud $crud, $table = "items") {
        $this->crud = $crud;
        $this->table = $table;
    }

    public function retrieveAllItems() {
        $data = "*";
        $sql = "SELECT $data FROM $this->table";
        $items = $this->crud->runSelectQuery($data, $this->table);
        return $items;
    }

    public function retrieveSpecificItem($column, $itemId) {
        $sql = "SELECT $column FROM $this->table WHERE id = ?";
        $params = [$itemId];
        return $this->crud->readOneRow($sql, $params);
    }

    public function insertIntoOrdersTable($userId, $itemId, $amount) {
        $sql = "INSERT INTO orders (user_id, item_id, amount) VALUES (?, ?, ?)";
        $params = [$userId, $itemId, $amount];
        $order = $this->crud->createRow($sql, $params);
        return $order;
    }

    //createProduct not strictly necessary to make webshop function
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

/*
$crud = new Crud();
$shopCrud = new ShopCrud($crud);

$data = $shopCrud->retrieveAllItems();
$data2 = $shopCrud->retrieveSpecificItem("item_name", 1);
$data3 = $shopCrud->insertIntoOrdersTable(1, 1, "");

var_dump($data);
echo "<br><br>";
var_dump($data2);
echo "<br><br>";
var_dump($data3);
*/

/*procedural functions to be converted:

function get_items($connection) {
	$items = array();
	$query = "SELECT * FROM items";
	$result = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($result)) {
			$items[] = $row; //misses closing bracket
	}
		return $items;
}

function get_specific_item_details($connection, $itemId) {
    $query = "SELECT item_name FROM items WHERE id = $itemId"; //could be more generic
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result); //returns one row
}

## function add_to_cart, should be handled in sessionmanager ##

function get_order_history($connection) { //used to fetch $user and $userid arguments too
    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user_id'];

		// Query to get items in the user's cart
        $query = "SELECT orders.id, items.item_name, orders.user_id, orders.amount FROM orders
                  JOIN items ON orders.item_id = items.id
                  WHERE orders.user_id = $userId"; 

        $result = mysqli_query($connection, $query);
		
		while ($row = mysqli_fetch_assoc($result)) {
			$orderHistory[] = $row;
		}
		
		if (empty($orderHistory)) {
			$orderHistory = ""; //if there is no order history, initialize it here
		} else {
			return $orderHistory;
		}
    } else {
        echo "you're not logged in!"; 
    }
}

function place_order($userId, $user, $connection) {
	//Check if the user == "guest"
    if (check_if_guest($user)) {
        return; // Stops rest of function
    }
	
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $itemId = $cartItem['itemId'];
			$amount = $cartItem['amount'];
            insert_into_orders_table($connection, $itemId, $user, $userId, $amount);
        }

        //Clearing the session cart after placing the order
        unset($_SESSION['cart']);
        echo "Order placed successfully!";
    } else {
        echo "Your cart is empty. Add items before placing an order.";
    }
}

function insert_into_orders_table($connection, $itemId, $user, $userId, $amount) {
		
        // Insert into the "orders" table
        $query = "INSERT INTO orders (user_id, item_id, amount) VALUES ($userId, $itemId, $amount)";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Error inserting into orders table: " . mysqli_error($connection));
        }
	
        /* not important for now
    $itemDetails = get_specific_item_details($connection, $itemId);
		//success message
    echo "Order made for item: " . $itemDetails['item_name'];
	echo "<br>";
    }

*/

?>
