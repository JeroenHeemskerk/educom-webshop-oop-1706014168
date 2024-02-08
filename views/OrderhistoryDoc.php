<?php

require_once "FormsDoc.php";

class OrderhistoryDoc extends FormsDoc {
	
    protected function showPageHeader() {
		echo '<h1>Webshop all details here</h1>';
	}

    protected function showContent() {
		$this->showOrders($this->model->orders);
	}

    private function showOrders($orders) {
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