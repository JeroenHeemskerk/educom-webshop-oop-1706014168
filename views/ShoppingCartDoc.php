<?php

//should retrieve the users shoppingcart from $_SESSION['cart']

	require_once "./views/ProductDoc.php";

class ShoppingCartDoc extends ProductDoc {
	
	function show_cart($connection) {
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
			echo '<h3>Shopping Cart:</h3>';
			echo '<table>';
			echo '<tr>
					<th>Item Name</th>
					<th>Item ID</th>
					<th>Amount</th>
				  </tr>';
	
			foreach ($_SESSION['cart'] as $cartItem) {
				$itemId = $cartItem['itemId'];
				$itemDetails = get_specific_item_details($this->connection, $itemId); // I think I should improve the structure
				
				echo '<tr>';
				echo '<td>' . $itemDetails['item_name']	. '</td>';
				echo '<td>' . $itemId . '</td>';
				echo '<td>' . $cartItem['amount'] . '</td>';
				echo '</tr>';
			}
	
			echo '</table>';
		} else {
			echo 'Your cart is empty.';
		}
	}
}

?>