<?php

	require_once "FormsDoc.php";

//used to inherit from productsdoc, dont know what the distinction was for
class ShoppingCartDoc extends FormsDoc {
	
	protected function showPageHeader() {
		echo '<h1>Shopping cart: all details here</h1>';
	}

	protected function showContent() {
		$this->showCart();
	}

	private function showCart() {
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
			echo '<input type="hidden" id="page" name="page" value="mycart">';
			echo '<td><button type="submit" class="submit" name="clearCart">Clear Cart</button></td>';

			echo '<tr>';
			echo '<td><button type="submit" class="submit" name="placeOrder">Place Order</button></td>';
			echo '</tr>';
	
			echo '</table>';
			echo '</form>';
		} else {
			echo 'Your cart is empty.';
		}
	}
}

?>