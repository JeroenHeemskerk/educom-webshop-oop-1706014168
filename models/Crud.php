<?php 

class Crud {

    //setting properties with default values
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "shops";

    protected $pdo;

    public function __construct() {
        $this->connect();
    }

    //Use PDO object to access database
    protected function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $this->pdo = new PDO($dsn, $this->user, $this->pwd);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetches associative array
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function runSelectQuery($data, $table) {
        try {
            $query = "SELECT $data FROM $table";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(); //Fetching all rows
        } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
           return false;
        }
    }

    public function createRow($sql, $params) {
        //Prepare statement
        try {
        $stmt = $this->pdo->prepare($sql);

        //Execute statement with parameters
        $stmt->execute($params);

        //Retrieve ID last inserted row
        $rowId = $this->pdo->lastInsertId();
        
        return $rowId;

        } catch(PDOException $e) {
            //Handle errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function readOneRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_OBJ); //fetching as object

            return $row;

        } catch(PDOException $e) {
            //ERROR handling
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function readMultipleRows($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetches all rows as associative array

            return $rows;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            //how many rows affected:
            return $stmt->rowCount();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteRow($sql, $params) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch(PDOException $e) {
            echo "Error " . $e->getmessage();
            return false;
        }
    }

}

/*
$crud = new Crud();

//select table
$data = 'username, password_hashed';
$table = 'username';

$result = $crud->runSelectQuery($data, $table);

if ($result !== false) {
    var_dump($result);
} else {
    echo "an error occurred while executing query";
}

//create a row
$table = "username";
$column = "username, password_hashed";
$sql = "INSERT INTO $table ($column) VALUES (?, ?)";
$params = ["testingCRUD", "CRUD"];

$rowId = $crud->createRow($sql, $params);

if($rowId !== false) {
    echo "Row inserted succesfully. RowId: $rowId"; //rowid returned
} else {
    echo "unsuccessful";
}

echo "<br><br>";

//read one row and return object
$table = "username";
$column = "id";


$sql = "SELECT * FROM $table WHERE $column = ?";
$params = [1]; // Example parameter id = 1

$row = $crud->readOneRow($sql, $params);

if($row) {
    var_dump($row); //Displaying the fetched row as an object
} else {
    echo "Unable to fetch the row.";
}

//read multiple rows and return array of objects or classes
$table = "orders";
$column = "amount";
$sql = "SELECT * FROM $table WHERE $column = ?"; //returns all orders where the amount is 3
$params = ["3"];

$rows = $crud->readMultipleRows($sql, $params);

if ($rows) {
    foreach ($rows as $row) {
        var_dump($row);
        echo "<br>";
    }
} else {
    echo "No such rows detected.";
}

//update example:

$table = "username";
$sql = "UPDATE $table SET username = ? WHERE id = ?";
$params = ["Guest", 1]; //Parameters: new name and ID of the row to update

$rowsAffected = $crud->updateRow($sql, $params);

if ($rowsAffected !== false) {
    echo "Rows updated: " . $rowsAffected;
} else {
    echo "Failed to update rows.";
}

//delete example:

$table = "username";
$sql = "DELETE FROM $table WHERE id = ?";
$params = [4]; // Example parameter: ID of the row to delete

$rowsAffected = $crud->deleteRow($sql, $params);

if ($rowsAffected !== false) {
    echo "<br>Rows deleted: " . $rowsAffected;
} else {
    echo "Failed to delete rows.";
}
*/

?>