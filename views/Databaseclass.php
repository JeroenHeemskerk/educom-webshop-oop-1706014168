<?php

//The most generic database connection function should be placed here.

//Im just not sure how to structure all of it and what is best practise. 

$mysqli = new mysqli("localhost", "root", "", "animals");

class Database { 
//should animals become a subclass? should I somehow define the instances retrieved from Db
//as part of animals class or not yet? Ill just try
	protected $table;
	protected $data;
	protected $mysqli;
	
	private function __construct($mysqli) {
		$this->mysqli = $mysqli;
	}
	
	public function run_select_query($data, $table) {
		$this->data = $data;
		$this->table = $table; 
		$query = "SELECT $this->data FROM $this->table";

		$result = $this->mysqli->query($query);

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$instance = $this->create_instance($row); 
				$instances[] = $instance;
			}
		} else {
			echo "Error in prepared statement: " . $this->mysqli->error;
		}	
		return $instances;
	}
	
	public function run_insert_query($data, $table) { //poorly tested for now
        $this->data = $data;
        $this->table = $table;
        $query = "INSERT INTO $this->table SET $this->data";

        $result = $this->mysqli->query($query);

        if ($result) {
            echo "Data inserted successfully!";
        } else {
            echo "Error in insert query: " . $this->mysqli->error;
        }
    }
	
	public function create_instance($row) {
		$className = $row['type']; //we retrieve the $row 'type, as that always equals a class name
		
		if(class_exists($className)) { //thank you php
			return new $className($row['name'], $row['type']); //it will "put" the right animal at the right subclass, if it exists
		} 
	}
	
	protected function add_user_database($connection, $user, $hashedPassword) {
		
	}
	
	protected function retrieve_userdata($connection, $user) {
		
	}
	
	public function get_username_id($connection, $user) {
		
	}
	
	protected function get_items($connection, $user) {
		
	}
	
	protected get_specific_item_details($connection, $itemId) {
		
	}
	
	protected add_to_cart($itemId, $userId, $amount) {
		
	}
	
	protected get_order_history($connection, $user, $userId) {
		
	}
	
	protected place_order($userId, $user, $connection) {
		
	}
}


?>