<?php

//This should retrieve the product items from the database and display them.

//This page should also show the shopping cart. 

	require_once "FormsDoc.php";

class WebshopDoc extends FormsDoc {
	protected function showPageHeader() {
		echo '<h1>Webshop all details here</h1>';
	}

	protected function showContent() {
		$this->showProducts($this->model->items);
		//$this->show_cart();
		//$this->show_orders($this->model->orders);
	}

	private function showProducts($items) { 
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
			echo '<input type="hidden" id="page" name="page" value="Shop">';
			echo '<input type="number" name="amount[' . $item['id'] . ']" min="1" value="1" required>';
			echo '</td>';
			echo '<td>';
			
			//I want the input type to pass the itemID instead of the button
			
			echo '<input type="hidden" id="itemId" name="itemId" value="34657" />';
			
			echo '<button type="submit" class="submit" name="addToCart" value="' . $item['id'] . '">Add to Cart</button>'; 
			echo '</td>';
			echo '</tr>';
		}
	
		echo '</table>';
		echo '</form>';
	}
}





?>