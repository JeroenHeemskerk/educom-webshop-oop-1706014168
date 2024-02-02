<?php

class Crud {

    //setting properties with default values
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "shops";

    public $table;
    public $data;

    protected function connect() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetches associative array
        return $pdo;
    }

    public function runSelectQuery() {
		$this->data = $data;
		$this->table = $table; 
		$query = "SELECT $this->data FROM $this->table";
    }

    public function createRow($sql, $params) {



        $rowId = $row['id'];
        return $row['id'];
    }

    public function readOneRow($sql, $params) {

    }

    public function readMultipleRows($sql, $params) {

    }

    public function updateRow($sql, $params) {

    }

    public function deleteRow($sql, $params) {

    }
}



//One of my functions currently using prepared statements:
function add_user_database_pdo($connection, $user, $hashedPassword) {
    //Insert user data into database
    $insertQuery = "INSERT INTO username (username, password_hashed) VALUES (?, ?)";
    $stmt = $connection->prepare($insertQuery);
    
    if (!$stmt) {
        //Handles the case where prepare() fails
        echo "Error: " . $connection->error; // Output the error message
        return false;
    }
    
    //Bind parameters and execute query
    $stmt->bind_param("ss", $user, $hashedPassword);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        return true; //user insertion succesful
    } else {
        return false; //failed
    }
    }

?>