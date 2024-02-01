<?php

//This should retrieve the product items from the database and display them.

//This page should also show the shopping cart. 

	require_once "FormsDoc.php";

class WebshopDoc extends FormsDoc {
	
	protected function showPageHeader() {
		echo '<h1>Webshop all details here</h1>';
	}

	protected function showContent() {
		$this->show_logout();
		$this->show_products($this->model->items);
		$this->show_cart();
		$this->show_orders($this->model->orders);
	}

	private function show_logout() {
		if (isset($_SESSION['user'])) { 
			echo '<form method="post">';
			echo '<input type="hidden" id="page" name="page" value="home">';
			echo '<td><button type="submit" class="submit" name="logout">Logout</button></td>';
			echo '<form>';

			//maybe better as menu item
		}
	}

	private function show_products($items) { 
		echo '<form method="post">';
		echo '<table>';
		echo '<tr>
				<th>Item</th>
				<th>Image</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Amount</th>
				<th>Add to cart</th>
			  </tr>';
		
		foreach($items as $item) {
			echo '<tr>';
			echo '<td>' . $item['id'] . '</td>';
			echo '<td><img src="' . $item['image_url'] . '" alt="Item Image" style="width:50px;height:50px;"></td>';
			echo '<td>' . $item['item_name'] . '</td>';
			echo '<td>' . $item['price'] . '</td>';
			echo '<td>';
			echo '<input type="hidden" id="page" name="page" value="browse_shop">';
			echo '<input type="number" name="amount[' . $item['id'] . ']" min="1" value="1" required>';
			echo '</td>';
			echo '<td>';
			
			//I want the input type to pass the itemID instead of the button
			
			echo '<input type="hidden" id="itemId" name="itemId" value="34657" />';
			
			echo '<button type="submit" class="submit" name="addToCart" value="' . $item['id'] . '">Add to Cart</button>'; 
			echo '</td>';
			echo '</tr>';
		}
		
		echo '<tr>';
		echo '<td><button type="submit" class="submit" name="placeOrder">Place Order</button></td>';
		echo '</tr>';
	
		echo '</table>';
		echo '</form>';
	}

	private function show_cart() {
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
			echo '<form method="post">';
			echo '<h3>Shopping Cart:</h3>';
			echo '<table>';
			echo '<tr>
					<th>Item Name</th>
					<th>Item ID</th>
					<th>Amount</th>
				  </tr>';
	
			foreach ($_SESSION['cart'] as $cartItem) {
				$itemId = $cartItem['itemId'];

				echo '<tr>';
				echo '<td>' . $cartItem['item_name']	. '</td>';
				echo '<td>' . $itemId . '</td>';
				echo '<td>' . $cartItem['amount'] . '</td>';
				echo '</tr>';
			}
			echo '<input type="hidden" id="page" name="page" value="browse_shop">';
			echo '<td><button type="submit" class="submit" name="clearCart">Clear Cart</button></td>';
	
			echo '</table>';
			echo '</form>';
		} else {
			echo 'Your cart is empty.';
		}
	}

	private function show_orders($orders) {
		if (!empty($orders)) {
			echo '<form method="post">';
			echo '<table>';
			echo '<tr>
					<th>User Id</th>
					<th>Item Id</th>
					<th>Amount</th>
				</tr>';
			
			foreach($orders as $order) {
				echo '<tr>';
				echo '<td>' . $order['user_id'] . '</td>';
				echo '<td>' . $order['item_name'] . '</td>';
				echo '<td>' . $order['amount'] . '</td>';
				echo '</tr>';
			}	
			echo '</table>';
			echo '</form>';
		} else {
			echo 'cart is empty';
		}
	}
}





?>